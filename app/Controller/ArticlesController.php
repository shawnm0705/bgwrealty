<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('view', 'view_more');
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_add','employee_edit', 'employee_index', 'employee_myindex', 
	    		'employee_view', 'employee_view_more', 'employee_delete');
	    }elseif($this->Auth->user('role') == 'customer'){
	    	$this->Auth->allow('customer_index', 'customer_view', 'customer_view_more');
	    }
    }

    public $uses = array('Article', 'Suburb', 'Property', 'Employee');

    public $TYPES_LIST = array(
    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态',
 		'JGXX' => '价格信息', 'LPXX' => '楼盘信息', 'ZCXXN' => '政策信息(内部)', 'SZGHN' => '市政规划(内部)', 'MZTJ' => '每周推荐',
 		'SJFX' => '数据分析', 'ZCYJ' => '政策研究', 'QYYJ' => '区域研究', 'XMYJ' => '项目研究',
 		'SJFXN' => '数据分析(内部)', 'ZCYJN' => '政策研究(内部)', 'QYYJN' => '区域研究(内部)', 'XMYJN' => '项目研究(内部)');
    public $TYPES_ARRAY = array(
    	'外部文章' => array(
    		'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'),
    	'内部通知' => array(
    		'JGXX' => '价格信息', 'LPXX' => '楼盘信息', 'ZCXXN' => '政策信息(内部)', 'SZGHN' => '市政规划(内部)', 'MZTJ' => '每周推荐'),
    	'研究报告(外部)' => array(
    		'SJFX' => '数据分析', 'ZCYJ' => '政策研究', 'QYYJ' => '区域研究', 'XMYJ' => '项目研究'),
    	'研究报告(内部)' => array(
    		'SJFXN' => '数据分析(内部)', 'ZCYJN' => '政策研究(内部)', 'QYYJN' => '区域研究(内部)', 'XMYJN' => '项目研究(内部)'));
    public $TYPES_CUSTOMER = array('YNDT', 'SCSJ', 'ZCXX', 'SZGH', 'JJDT', 'SJFX', 'ZCYJ', 'QYYJ', 'XMYJ');
    public $TYPES_LIST_CUSTOMER = array(
    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态',
 		'SJFX' => '数据分析', 'ZCYJ' => '政策研究', 'QYYJ' => '区域研究', 'XMYJ' => '项目研究');
    public $TYPES_ARRAY_CUSTOMER = array(
    	'各类文章' => array(
    		'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'),
    	'研究报告' => array(
    		'SJFX' => '数据分析', 'ZCYJ' => '政策研究', 'QYYJ' => '区域研究', 'XMYJ' => '项目研究'));

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Article->recursive = -1;
		$this->set('articles', $this->Article->find('all'));
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$employees = $this->Employee->find('list');
		$employees[0] = '管理员';
		$this->set(compact('suburbs', 'properties', 'employees'));
		$this->set('types_list', $this->TYPES_LIST);
	}

	public function employee_index() {
		$this->Article->recursive = -1;
		$options = array('conditions' => array('status' => 'APPROVAL'),
			'order' => 'date DESC');
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$this->set('articles', $articles);
		$this->set('types_array', $this->TYPES_ARRAY);
		$this->set('role', $this->Auth->user('role'));
	}

	public function customer_index() {
		$this->Article->recursive = -1;
		$options = array('conditions' => array('status' => 'APPROVAL'),
			'order' => 'date DESC');
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$this->set('articles', $articles);
		$this->set('types_array', $this->TYPES_ARRAY_CUSTOMER);
		$this->set('role', $this->Auth->user('role'));
	}

	public function employee_myindex() {
		$this->Article->recursive = -1;
		$options = array('conditions' => 'employee_id = '.$this->Auth->user('role_id'));
		$this->set('articles', $this->Article->find('all', $options));
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_list', $this->TYPES_LIST);
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->Article->recursive = -1;
		$this->set('article', $this->Article->find('first', array('conditions' => 'id = '.$id)));
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$employees = $this->Employee->find('list');
		$employees[0] = '管理员';
		$this->set(compact('suburbs', 'properties', 'employees'));
		$this->set('types_list', $this->TYPES_LIST);
	}

	public function employee_view($id = null){
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->Article->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$article = $this->Article->find('first', $options);
		if($article['Article']['status'] == 'DRAFT' && $article['Article']['employee_id'] != $this->Auth->user('role_id')){
			return $this->redirect(array('action' => 'index'));
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties', 'article'));
		$this->set('types_list', $this->TYPES_LIST);
		$this->set('role', $this->Auth->user('role'));
	}

	public function customer_view($id = null){
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->Article->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'status' => 'APPROVAL'));
		$article = $this->Article->find('first', $options);
		if(!$article || !isset($this->TYPES_LIST_CUSTOMER[$article['Article']['type']])){
			return $this->redirect(array('action' => 'index'));
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties', 'article'));
		$this->set('types_list', $this->TYPES_LIST_CUSTOMER);
		$this->set('role', $this->Auth->user('role'));
	}

	public function employee_view_more($this_type = null){
		if(!$this_type){
			return $this->redirect(array('action' => 'index'));
		}
		$options = array(
			'conditions' => array('status' => 'APPROVAL'),
			'order' => 'date DESC');
		$this->Article->recursive = -1;
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$this->set('types_list', $this->TYPES_LIST);
		$this->set(compact('articles','this_type'));
		$this->set('role', $this->Auth->user('role'));
	}

	public function customer_view_more($this_type = null){
		if(!$this_type || !isset($this->TYPES_LIST_CUSTOMER[$this_type])){
			return $this->redirect(array('action' => 'index'));
		}
		$options = array(
			'conditions' => array('status' => 'APPROVAL', 'type' => $this->TYPES_CUSTOMER),
			'order' => 'date DESC');
		$this->Article->recursive = -1;
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$this->set('types_list', $this->TYPES_LIST_CUSTOMER);
		$this->set(compact('articles','this_type'));
		$this->set('role', $this->Auth->user('role'));
	}

	public function view($id = null){
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->Article->recursive = -1;
		$this->set('article', $this->Article->find('first', array('conditions' => 'id = '.$id)));
		$suburbs = $this->Suburb->find('list');
		$properties = $this->Property->find('list');
		$this->set(compact('suburbs', 'properties'));

		// Articles
		$types = array('YNDT', 'SCSJ', 'ZCXX', 'SZGH', 'JJDT');
		$options = array(
			'conditions' => array('type' => $types, 'status' => 'APPROVAL'),
			'order' => 'date DESC');
		$this->Article->recursive = -1;
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$this->set('articles', $articles);
		$this->set('types_list', array(
	    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'));
	}

	public function view_more($this_type = null){
		$types = array('YNDT', 'SCSJ', 'ZCXX', 'SZGH', 'JJDT');
		$options = array(
			'conditions' => array('type' => $types, 'status' => 'APPROVAL'),
			'order' => 'date DESC');
		$this->Article->recursive = -1;
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$this->set('articles', $articles);
		$this->set('types_list', array(
	    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'));
		$this->set('this_type', $this_type);
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Article']['date'] = date('Y-m-d H:i:s');
			$this->request->data['Article']['employee_id'] = 0;
			$this->request->data['Article']['status'] = 'APPROVAL';
			$file = $this->request->data['Article']['filename'];
			if($file['name']){
				if($file['error']){
					$this->Session->setFlash(__('上传文件有错误.'));
					return $this->redirect(array('action' => 'add'));
				}else{
					move_uploaded_file($file['tmp_name'], WWW_ROOT.'files'.DS.'Article'.DS.$file['name']);
					$this->request->data['Article']['filename'] = $file['name'];
				}
			}else{
				$this->request->data['Article']['filename'] = '';
			}
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('文章已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('文章保存失败，请稍候再试.'));
			}
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_array', $this->TYPES_ARRAY);
	}

	public function employee_add() {
		if ($this->request->is('post')) {
			$this->request->data['Article']['date'] = date('Y-m-d H:i:s');
			$this->request->data['Article']['employee_id'] = $this->Auth->user('role_id');
			$this->request->data['Article']['status'] = 'DRAFT';
			$file = $this->request->data['Article']['filename'];
			if($file['name']){
				if($file['error']){
					$this->Session->setFlash(__('上传文件有错误.'));
					return $this->redirect(array('action' => 'add'));
				}else{
					move_uploaded_file($file['tmp_name'], WWW_ROOT.'files'.DS.'Article'.DS.$file['name']);
					$this->request->data['Article']['filename'] = $file['name'];
				}
			}else{
				$this->request->data['Article']['filename'] = '';
			}
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('文章已保存.'));
				return $this->redirect(array('action' => 'myindex'));
			} else {
				$this->Session->setFlash(__('文章保存失败，请稍候再试.'));
			}
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_array', $this->TYPES_ARRAY);
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$file = $this->request->data['Article']['filename'];
			if($file['name']){
				if($file['error']){
					$this->Session->setFlash(__('上传文件有错误.'));
					return $this->redirect(array('action' => 'edit', $id));;
				}else{
					move_uploaded_file($file['tmp_name'], WWW_ROOT.'files'.DS.'Article'.DS.$file['name']);
					$this->request->data['Article']['filename'] = $file['name'];
				}
			}else{
				unset($this->request->data['Article']['filename']);
			}
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('文章已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('文章保存失败，请稍候再试.'));
			}
		}else{
			$this->Article->recursive = -1;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_array', $this->TYPES_ARRAY);
		$this->set('type_selected', $this->request->data['Article']['type']);
	}

	public function employee_edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$file = $this->request->data['Article']['filename'];
			if($file['name']){
				if($file['error']){
					$this->Session->setFlash(__('上传文件有错误.'));
					return $this->redirect(array('action' => 'edit', $id));;
				}else{
					move_uploaded_file($file['tmp_name'], WWW_ROOT.'files'.DS.'Article'.DS.$file['name']);
					$this->request->data['Article']['filename'] = $file['name'];
				}
			}else{
				unset($this->request->data['Article']['filename']);
			}
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('文章已保存.'));
				return $this->redirect(array('action' => 'myindex'));
			} else {
				$this->Session->setFlash(__('文章保存失败，请稍候再试.'));
			}
		}else{
			$this->Article->recursive = -1;
			$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('role_id'), 'status' => 'DRAFT'));
			$this->request->data = $this->Article->find('first', $options);
			if(!$this->request->data){
				return $this->redirect(array('action' => 'myindex'));
			}
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_array', $this->TYPES_ARRAY);
		$this->set('type_selected', $this->request->data['Article']['type']);
		$this->set('role', $this->Auth->user('role'));
	}

	public function admin_change_s($id = null){
		$this->layout = false;
		$article = array();
		$article['Article']['id'] = $id;
		$article['Article']['status'] = $this->request->query['status'];
		$this->Article->save($article);
		if($article['Article']['status'] == 'DRAFT'){
			echo '审核中<a href="#status" class="btn btn-custom button-small" onclick="change_s('.$id.',1)" id="btn-status">审核通过</a>';
		}elseif($article['Article']['status'] == 'APPROVAL'){
			echo '已审核通过<a href="#status" class="btn btn-custom button-small" onclick="change_s('.$id.',0)" id="btn-status">改为审核中</a>';

		}
		$this->render('empty');
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('文章已删除.'));
		} else {
			$this->Session->setFlash(__('文章删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function employee_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->Article->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$article = $this->Article->find('first', $options);
		if($article['Article']['status'] == 'APPROVAL' || $article['Article']['employee_id'] != $this->Auth->user('role_id')){
			return $this->redirect(array('action' => 'myindex'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('文章已删除.'));
		} else {
			$this->Session->setFlash(__('文章删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'myindex'));
	}
}
