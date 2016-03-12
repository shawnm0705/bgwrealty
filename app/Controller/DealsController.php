<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Deals Controller
 *
 * @property Deal $Deal
 */
class DealsController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_add', 'employee_edit', 'employee_index', 'employee_delete', 'employee_view', 'saf');
	    }
    }

    public $uses = array('Deal', 'Employee', 'Customer', 'Property', 'Page');

    public $STATUS_LIST = array('C' => '出合同', 'Q' => '签合同', 'J' => '交换合同', 'D' => '贷款', 'Y' => '验房', 
    	'JF' => '交房', 'CZ' => '出租');
    public $TYPES = array('ZS' => array('C', 'Q'), 'CJ' => array('J', 'D', 'Y', 'JF', 'CZ'));
    public $STATUS_TYPES = array('C' => 'ZS','Q' => 'ZS','J' => 'CJ','D' => 'CJ', 'Y' => 'CJ', 'JF' => 'CJ', 'CZ' => 'CJ');
    public $STATUS_DATE = array('C' => 'c_date', 'Q' => 'q_date', 'J' => 'j_date', 'D' => 'd_date', 'Y' => 'y_date', 
    	'JF' => 'jf_date', 'CZ' => 'cz_date');
    public $NEXT_STATUS = array('C' => 'Q', 'Q' => 'J', 'J' => 'D', 'D' => 'Y', 'Y' => 'JF', 'JF' => 'CZ', 'CZ' => '');
    public $NEXT_STATUS_DATE = array('C' => 'q_date', 'Q' => 'j_date', 'J' => 'd_date', 'D' => 'y_date', 
    	'Y' => 'jf_date', 'JF' => 'cz_date');
/**
 * index method
 *
 * @return void
 */
	public function admin_index($type = null) {
		if(!$type){
			$type = 'ZS';
		}
		$this->Deal->recursive = 0;
		$options = array('conditions' => array('Deal.status' => $this->TYPES[$type]));
		$this->set('deals', $this->Deal->find('all', $options));
		$this->set('status_list', $this->STATUS_LIST);
		$this->set('status_date', $this->STATUS_DATE);
		$this->set('type', $type);
	}

	public function employee_index($type = null) {
		$role = $this->Auth->user('role');
		if($type == null){
			$type = 'ZS';
		}
		$this->Deal->recursive = 0;
		$options = array('conditions' => 
			array('Deal.employee_id' => $this->Auth->user('id'), 'Deal.status' => $this->TYPES[$type]));
		$this->set('deals', $this->Deal->find('all', $options));
		$this->set('status_list', $this->STATUS_LIST);
		$this->set('status_date', $this->STATUS_DATE);
		$this->set('next_status', $this->NEXT_STATUS);
		$this->set('type', $type);
		$this->set('role', $role);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('销售信息不存在'));
		}
		$this->Deal->recursive = 0;
		$options = array('conditions' => array('Deal.id' => $id));
		$this->set('deal', $this->Deal->find('first', $options));
		$this->set('status_types', $this->STATUS_TYPES);
	}

	public function employee_view($id = null){
		$role = $this->Auth->user('role');
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('销售信息不存在'));
		}
		$this->Deal->recursive = 0;
		$options = array('conditions' => array('Deal.id' => $id, 'Deal.employee_id' => $this->Auth->user('id')));
		$deal = $this->Deal->find('first', $options);
		if(!$deal){
			return $this->redirect(array('action' => 'index', 'ZS'));
		}
		$this->set('status_types', $this->STATUS_TYPES);
		$this->set(compact('role', 'deal'));
	}

	public function saf($id = null){
		$this->layout = false;
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException('销售信息不存在');
		}
		$this->Deal->recursive = 0;
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
			$options = array('conditions' => array('Deal.id' => $id, 'Deal.employee_id' => $this->Auth->user('id')));
		}
		$options = array('conditions' => array('Deal.id' => $id));
		$deal = $this->Deal->find('first', $options);
		if(!$deal){
			return $this->redirect(array('employee' => true, 'controller' => 'deals', 'action' => 'index', 'ZS'));
		}
		$this->set('deal', $deal);
		$this->Page->recursive = -1;
		$page_list = $this->Page->find('all');
		$pages = array();
		foreach($page_list as $page){
			$cate = $page['Page']['cate'];
			$content = $page['Page']['content'];
			if($cate == '电话' || $cate == 'E-mail' || $cate == '地址'){
				$pages[$cate] = $content;
			}
		}
		$this->set('pages', $pages);
	}

/**
 * add method
 *
 * @return void
 */
/*
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Deal']['number'] = 0;
			$this->Deal->create();
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('销售信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('销售信息保存失败，请稍候再试.'));
			}
		}
		//$this->set('role', $this->Auth->user('role'));
	}
*/
	public function employee_add($status = null) {
		if(!$status || !isset($this->STATUS_LIST[$status]) || 
			!isset($this->request->query['deal_id']) && $status != 'C'){
			return $this->redirect(array('action' => 'index', 'ZS'));
		}
		$role = $this->Auth->user('role');
		if ($this->request->is('post')) {
			if($status == 'C'){
				$this->request->data['Deal']['employee_id'] = $this->Auth->user('id');
				$this->Deal->create();
				$deal_id = $this->Deal->id;
			}elseif(isset($this->request->data['Deal']['id'])){
				$deal_id = $this->request->data['Deal']['id'];
			}else{
				return $this->redirect(array('action' => 'index', 'ZS'));
			}

			$s_date = $this->STATUS_DATE[$status];
			$this->request->data['Deal'][$s_date] = date('Y-m-d H:i:s');
			switch ($status){
				case 'C':
				  	$file_cols = array('c_djpz');
					break;  
				case 'Q':
				  	$file_cols = array('q_10pz');
					break;
			  	case 'J':
				  	$file_cols = array('j_lshh', 'j_htsy');
					break;
				default:
					$file_cols = array();
			}
			foreach($file_cols as $file_col){
				// Upload files
				$file = $this->request->data['Deal'][$file_col];
				if($file['name']){
					if($file['error']){
						$this->Session->setFlash(__('上传文件有错误.'));
						return 0;
					}else{
						$dir_path = WWW_ROOT.'files'.DS.'Deal'.DS.$deal_id.DS;
						$dir = new Folder($dir_path);
						move_uploaded_file($file['tmp_name'], $dir_path.$file['name']);
						$this->request->data['Deal'][$file_col] = $file['name'];
					}
				}else{
					$this->request->data['Deal'][$file_col] = '';
				}
			}
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('销售信息已保存.'));
				return $this->redirect(array('action' => 'index', 
					$this->STATUS_TYPES[$this->request->data['Deal']['status']]));
			} else {
				$this->Session->setFlash(__('销售信息保存失败，请稍候再试.'));
			}
		}
		if(isset($this->request->query['deal_id'])){
			$this->set('id', $this->request->query['deal_id']);
		}else{
			$this->Customer->recursive = -1;
			$options = array('conditions' => 'employee_id = '.$this->Auth->user('id'));
			$this->set('customers', $this->Customer->find('list', $options));
			$this->Property->recursive = -1;
			$this->set('properties', $this->Property->find('list'));
		}
		$this->set('status_list', $this->STATUS_LIST);
		$this->set('status', $status);
		$this->set('role', $role);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function admin_edit($id = null) {
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('销售信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('销售信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('销售信息保存失败，请稍候再试.'));
			}
		}else{
			$this->Deal->recursive = 0;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Deal->find('first', $options);
		}
		$this->set('type_list', $this->TYPE_LIST_L);
	}
*/
	public function employee_edit($id = null) {
		if (!$this->Deal->exists($id)) {
			return $this->redirect(array('action' => 'index', 'ZS'));
		}
		if ($this->request->is(array('post', 'put'))) {
			switch ($this->request->data['Deal']['status']){
				case 'C':
				  	$file_cols = array('c_djpz');
					break;  
				case 'Q':
				  	$file_cols = array('q_10pz');
					break;
			  	case 'J':
				  	$file_cols = array('j_lshh', 'j_htsy');
					break;
				default:
					$file_cols = array();
			}
			foreach($file_cols as $file_col){
				// Upload files
				$file = $this->request->data['Deal'][$file_col];
				if($file['name']){
					if($file['error']){
						$this->Session->setFlash(__('上传文件有错误.'));
						return 0;
					}else{
						$dir_path = WWW_ROOT.'files'.DS.'Deal'.DS.$id.DS;
						new Folder($dir_path, true, 0755);
						move_uploaded_file($file['tmp_name'], $dir_path.$file['name']);
						$this->request->data['Deal'][$file_col] = $file['name'];
					}
				}else{
					unset($this->request->data['Deal'][$file_col]);
				}
			}
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('销售信息已保存.'));
				return $this->redirect(array('action' => 'index', 
					$this->STATUS_TYPES[$this->request->data['Deal']['status']]));
			} else {
				$this->Session->setFlash(__('销售信息保存失败，请稍候再试.'));
			}
		}else{
			$this->Deal->recursive = -1;
			$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('id')));
			$this->request->data = $this->Deal->find('first', $options);
			if(!$this->request->data){
				return $this->redirect(array('action' => 'index', 'ZS'));
			}
			$status = $this->request->data['Deal']['status'];
			$this->set('status', $status);
			$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
			$date = new DateTime($this->request->data['Deal'][$this->STATUS_DATE[$status]]);
			if($week_before >= $date){
				return $this->redirect(array('action' => 'index', $this->STATUS_TYPES[$status]));
			}
			if($status == 'C'){
				$this->Customer->recursive = -1;
				$options = array('conditions' => 'employee_id = '.$this->Auth->user('id'));
				$this->set('customers', $this->Customer->find('list', $options));
				$this->Property->recursive = -1;
				$this->set('properties', $this->Property->find('list'));
			}
		}
		$this->set('status_list', $this->STATUS_LIST);
		$role = $this->Auth->user('role');
		$this->set('role', $role);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Deal->id = $id;
		if (!$this->Deal->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Deal->delete()) {
			$this->Session->setFlash(__('销售信息已删除.'));
		} else {
			$this->Session->setFlash(__('销售信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function employee_delete($id = null) {
		$this->Deal->id = $id;
		if (!$this->Deal->exists()) {
			return $this->redirect(array('action' => 'index', 'ZS'));
		}
		$this->Deal->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('id')));
		$deal = $this->Deal->find('first', $options);
		$status = $deal['Deal']['status'];
		if(!$deal || $deal['Deal']['status'] != 'C'){
			return $this->redirect(array('action' => 'index', 'ZS'));
		}
		$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
		$date = new DateTime($deal['Deal'][$this->STATUS_DATE[$status]]);
		if($week_before >= $date){
			return $this->redirect(array('action' => 'index', 'ZS'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Deal->delete()) {
			$this->Session->setFlash(__('销售信息已删除.'));
		} else {
			$this->Session->setFlash(__('销售信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index', 'ZS'));
	}
}
