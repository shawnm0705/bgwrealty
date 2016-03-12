<?php
App::uses('AppController', 'Controller');
/**
 * Summaries Controller
 *
 * @property Summary $Summary
 */
class SummariesController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_add', 'employee_edit', 'employee_index', 'employee_delete');
	    }
    }

    public $uses = array('Summary', 'Employee');

    public $TYPE_LIST_L = array('YW-M' => '月业务总结', 'YW-Y' => '年业务总结', 'XM-Y' => '年项目总结', 'XM-M' => '月项目总结');
    public $TYPE_LIST_E = array('YW-M' => '月业务总结', 'YW-Y' => '年业务总结');
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Summary->recursive = 0;
		$this->set('summaries', $this->Summary->find('all'));
		$this->set('type_list', $this->TYPE_LIST_L);
	}

	public function employee_index() {
		$role = $this->Auth->user('role');
		$this->Summary->recursive = -1;
		$options = array('conditions' => 'Summary.employee_id = '.$this->Auth->user('role_id'));
		$this->set('summaries', $this->Summary->find('all', $options));
		if($role == 'employee'){
			$this->set('type_list', $this->TYPE_LIST_E);
		}elseif($role == 'leader'){
			$this->set('type_list', $this->TYPE_LIST_L);
		}
		$this->set('role', $role);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function admin_view($id = null){
		if (!$this->Summary->exists($id)) {
			throw new NotFoundException(__('总结不存在'));
		}
		$this->Summary->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$this->set('summary', $this->Summary->find('first', $options));
		$options = array('conditions' => array('summary_id' => $id));
		$this->set('employees', $this->Employee->find('all', $options));

	}
*/
/**
 * add method
 *
 * @return void
 */
/*
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Summary']['number'] = 0;
			$this->Summary->create();
			if ($this->Summary->save($this->request->data)) {
				$this->Session->setFlash(__('总结已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('总结保存失败，请稍候再试.'));
			}
		}
		//$this->set('role', $this->Auth->user('role'));
	}
*/
	public function employee_add() {
		$role = $this->Auth->user('role');
		if ($this->request->is('post')) {
			$this->request->data['Summary']['date'] = date('Y-m-d H:i:s');
			$this->request->data['Summary']['employee_id'] = $this->Auth->user('role_id');
			$this->Summary->create();
			if ($this->Summary->save($this->request->data)) {
				$this->Session->setFlash(__('总结已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('总结保存失败，请稍候再试.'));
			}
		}
		if($role == 'employee'){
			$this->set('type_list', $this->TYPE_LIST_E);
		}elseif($role == 'leader'){
			$this->set('type_list', $this->TYPE_LIST_L);
		}
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
		if (!$this->Summary->exists($id)) {
			throw new NotFoundException(__('总结不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Summary->save($this->request->data)) {
				$this->Session->setFlash(__('总结已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('总结保存失败，请稍候再试.'));
			}
		}else{
			$this->Summary->recursive = 0;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Summary->find('first', $options);
		}
		$this->set('type_list', $this->TYPE_LIST_L);
	}
*/
	public function employee_edit($id = null) {
		$role = $this->Auth->user('role');
		if (!$this->Summary->exists($id)) {
			throw new NotFoundException(__('总结不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Summary->save($this->request->data)) {
				$this->Session->setFlash(__('总结已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('总结保存失败，请稍候再试.'));
			}
		}else{
			$this->Summary->recursive = -1;
			$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('role_id')));
			$this->request->data = $this->Summary->find('first', $options);
			if(!$this->request->data){
				return $this->redirect(array('action' => 'index'));
			}
			$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
			$date = new DateTime($this->request->data['Summary']['date']);
			if($week_before >= $date){
				return $this->redirect(array('action' => 'index'));
			}
		}
		if($role == 'employee'){
			$this->set('type_list', $this->TYPE_LIST_E);
		}elseif($role == 'leader'){
			$this->set('type_list', $this->TYPE_LIST_L);
		}
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
		$this->Summary->id = $id;
		if (!$this->Summary->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Summary->delete()) {
			$this->Session->setFlash(__('总结已删除.'));
		} else {
			$this->Session->setFlash(__('总结删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function employee_delete($id = null) {
		$this->Summary->id = $id;
		if (!$this->Summary->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->Summary->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('role_id')));
		$summary = $this->Summary->find('first', $options);
		if(!$summary){
			return $this->redirect(array('action' => 'index'));
		}
		$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
		$date = new DateTime($summary['Summary']['date']);
		if($week_before >= $date){
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Summary->delete()) {
			$this->Session->setFlash(__('总结已删除.'));
		} else {
			$this->Session->setFlash(__('总结删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
