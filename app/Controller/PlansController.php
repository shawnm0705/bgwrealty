<?php
App::uses('AppController', 'Controller');
/**
 * Plans Controller
 *
 * @property Plan $Plan
 */
class PlansController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_add', 'employee_edit', 'employee_index', 'employee_delete');
	    }
    }

    public $uses = array('Plan', 'Employee');

    public $TYPE_LIST_L = array('YW-M' => '月业务计划', 'YW-Y' => '年业务计划', 'XM-Y' => '年项目计划', 'XM-M' => '月项目计划');
    public $TYPE_LIST_E = array('YW-M' => '月业务计划', 'YW-Y' => '年业务计划');
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Plan->recursive = 0;
		$this->set('plans', $this->Plan->find('all'));
		$this->set('type_list', $this->TYPE_LIST_L);
	}

	public function employee_index() {
		$role = $this->Auth->user('role');
		$this->Plan->recursive = -1;
		$options = array('conditions' => 'Plan.employee_id = '.$this->Auth->user('id'));
		$this->set('plans', $this->Plan->find('all', $options));
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
		if (!$this->Plan->exists($id)) {
			throw new NotFoundException(__('计划不存在'));
		}
		$this->Plan->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$this->set('plan', $this->Plan->find('first', $options));
		$options = array('conditions' => array('plan_id' => $id));
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
			$this->request->data['Plan']['number'] = 0;
			$this->Plan->create();
			if ($this->Plan->save($this->request->data)) {
				$this->Session->setFlash(__('计划已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('计划保存失败，请稍候再试.'));
			}
		}
		//$this->set('role', $this->Auth->user('role'));
	}
*/
	public function employee_add() {
		$role = $this->Auth->user('role');
		if ($this->request->is('post')) {
			$this->request->data['Plan']['date'] = date('Y-m-d H:i:s');
			$this->request->data['Plan']['employee_id'] = $this->Auth->user('id');
			$this->Plan->create();
			if ($this->Plan->save($this->request->data)) {
				$this->Session->setFlash(__('计划已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('计划保存失败，请稍候再试.'));
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
		if (!$this->Plan->exists($id)) {
			throw new NotFoundException(__('计划不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Plan->save($this->request->data)) {
				$this->Session->setFlash(__('计划已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('计划保存失败，请稍候再试.'));
			}
		}else{
			$this->Plan->recursive = 0;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Plan->find('first', $options);
		}
		$this->set('type_list', $this->TYPE_LIST_L);
	}
*/
	public function employee_edit($id = null) {
		$role = $this->Auth->user('role');
		if (!$this->Plan->exists($id)) {
			throw new NotFoundException(__('计划不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Plan->save($this->request->data)) {
				$this->Session->setFlash(__('计划已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('计划保存失败，请稍候再试.'));
			}
		}else{
			$this->Plan->recursive = -1;
			$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('id')));
			$this->request->data = $this->Plan->find('first', $options);
			if(!$this->request->data){
				return $this->redirect(array('action' => 'index'));
			}
			$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
			$date = new DateTime($this->request->data['Plan']['date']);
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
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Plan->delete()) {
			$this->Session->setFlash(__('计划已删除.'));
		} else {
			$this->Session->setFlash(__('计划删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function employee_delete($id = null) {
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->Plan->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('id')));
		$plan = $this->Plan->find('first', $options);
		if(!$plan){
			return $this->redirect(array('action' => 'index'));
		}
		$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
		$date = new DateTime($plan['Plan']['date']);
		if($week_before >= $date){
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Plan->delete()) {
			$this->Session->setFlash(__('计划已删除.'));
		} else {
			$this->Session->setFlash(__('计划删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
