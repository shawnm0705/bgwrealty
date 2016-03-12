<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 */
class ContactsController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_add', 'employee_edit', 'employee_index', 'employee_view', 'employee_delete');
	    }
    }

    public $uses = array('Contact', 'Employee', 'Customer', 'Property', 'Ptype', 'Ctype');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Contact->recursive = 0;
		$this->set('contacts', $this->Contact->find('all'));
	}

	public function employee_index($id = null) {
		if(!$id){
			$id = $this->Auth->user('role_id');
		}elseif($this->Auth->user('role') == 'leader'){
			// Leader
			$team_id = $this->request->query['team_id'];
			$this->Employee->recursive = -1;
			$options = array('conditions' => array('id' => $id, 'team_id' => $team_id));
			$employee = $this->Employee->find('first', $options);
			if(!$employee){
				return $this->redirect(array('controller' => 'teams', 'action' => 'myteam'));	
			}
			$this->set('employee', $employee);
		}else{
			return $this->redirect(array('controller' => 'teams', 'action' => 'myteam'));
		}
		$this->Contact->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'customers', 'alias' => 'Customer', 
					'conditions' => 'Contact.customer_id = Customer.id')),
			'conditions' => 'Contact.employee_id = '.$id,
			'fields' => array('Customer.name', 'Contact.*'));
		$this->set('contacts', $this->Contact->find('all', $options));
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
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('联系记录不存在'));
		}
		$this->Contact->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'customers', 'alias' => 'Customer',
					'conditions' => 'Contact.customer_id = Customer.id'),
				array('table' => 'employees', 'alias' => 'Employee',
					'conditions' => 'Contact.employee_id = Employee.id'),
				array('table' => 'properties', 'alias' => 'Property', 'type' => 'left',
					'conditions' => 'Contact.property_id = Property.id'),
				array('table' => 'ptypes', 'alias' => 'Ptype', 'type' => 'left',
					'conditions' => 'Contact.ptype_id = Ptype.id'),
				array('table' => 'ctypes', 'alias' => 'Ctype', 'type' => 'left',
					'conditions' => 'Contact.ctype_id = Ctype.id')),
			'conditions' => array('Contact.id' => $id),
			'fields' => array('Contact.*', 'Customer.name','Employee.name','Property.name','Ptype.name','Ctype.name'));
		$this->set('contact', $this->Contact->find('first', $options));

	}

	public function employee_view($id = null){
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('联系记录不存在'));
		}
		if(isset($this->request->query['employee_id'])){
			$employee_id = $this->request->query['employee_id'];
		}else{
			$employee_id = $this->Auth->user('role_id');
		}
		$role = $this->Auth->user('role');
		$this->Contact->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'customers', 'alias' => 'Customer',
					'conditions' => 'Contact.customer_id = Customer.id'),
				array('table' => 'properties', 'alias' => 'Property', 'type' => 'left',
					'conditions' => 'Contact.property_id = Property.id'),
				array('table' => 'ptypes', 'alias' => 'Ptype', 'type' => 'left',
					'conditions' => 'Contact.ptype_id = Ptype.id'),
				array('table' => 'ctypes', 'alias' => 'Ctype', 'type' => 'left',
					'conditions' => 'Contact.ctype_id = Ctype.id')),
			'conditions' => array('Contact.id' => $id, 'Contact.employee_id' => $employee_id),
			'fields' => array('Contact.*', 'Customer.name','Property.name','Ptype.name','Ctype.name'));
		$contact = $this->Contact->find('first', $options);
		if($contact){
			$this->set('contact', $contact);
		}else{
			if($role == 'employee'){
				return $this->redirect(array('action' => 'index'));
			}else{
				return $this->redirect(array('controller' => 'teams', 'action' => 'myteam'));
			}
		}
		$this->set('role', $role);
	}

/**
 * add method
 *
 * @return void
 */
/*
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Contact']['number'] = 0;
			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('联系记录已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('联系记录保存失败，请稍候再试.'));
			}
		}
		//$this->set('role', $this->Auth->user('role'));
	}
*/
	public function employee_add() {
		if ($this->request->is('post')) {
			if($this->request->data['Contact']['time']['year'] && $this->request->data['Contact']['time']['month'] &&
				$this->request->data['Contact']['time']['day'] && $this->request->data['Contact']['customer_id']){

				$time = $this->request->data['Contact']['time']['year'].'-'.$this->request->data['Contact']['time']['month'].'-'.$this->request->data['Contact']['time']['day'];
				$this->request->data['Contact']['time'] = $time;
				$this->request->data['Contact']['date'] = date('Y-m-d H:i:s');
				$this->request->data['Contact']['employee_id'] = $this->Auth->user('role_id');
				$this->Contact->create();
				if ($this->Contact->save($this->request->data)) {
					$this->Session->setFlash(__('联系记录已保存.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('联系记录保存失败，请稍候再试.'));
				}
			}else{
				$this->Session->setFlash(__('信息不完整.'));
			}
		}
		$this->Customer->recursive = -1;
		$options = array('conditions' => 'employee_id = '.$this->Auth->user('role_id'));
		$this->set('customers', $this->Customer->find('list',$options));
		$this->Property->recursive = -1;
		$this->set('properties', $this->Property->find('list'));
		$this->Ptype->recursive = -1;
		$this->set('ptypes', $this->Ptype->find('list'));
		$this->Ctype->recursive = -1;
		$options = array('conditions' => array('type' => 'KHFL'));
		$this->set('ctypes', $this->Ctype->find('list', $options));
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function admin_edit($id = null) {
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('联系记录不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('联系记录已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('联系记录保存失败，请稍候再试.'));
			}
		}else{
			$this->Contact->recursive = -1;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Contact->find('first', $options);
		}
	}
*/
	public function employee_edit($id = null) {
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('联系记录不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data['Contact']['time'] && $this->request->data['Contact']['customer_id']){
				if ($this->Contact->save($this->request->data)) {
					$this->Session->setFlash(__('联系记录已保存.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('联系记录保存失败，请稍候再试.'));
				}
			}else{
				$this->Session->setFlash(__('信息不完整.'));
			}
		}else{
			$this->Contact->recursive = -1;
			$options = array('conditions' => array('id' => $id, 'employee_id' => $this->Auth->user('role_id')));
			$this->request->data = $this->Contact->find('first', $options);
			if(!$this->request->data){
				return $this->redirect(array('action' => 'index'));
			}
			$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
			$date = new DateTime($this->request->data['Contact']['date']);
			if($this->request->data['Contact']['employee_id'] != $this->Auth->user('role_id') || $week_before >= $date){
				return $this->redirect(array('action' => 'index'));
			}
			$this->Customer->recursive = -1;
			$options = array('conditions' => 'employee_id = '.$this->Auth->user('role_id'));
			$this->set('customers', $this->Customer->find('list',$options));
			$this->Property->recursive = -1;
			$this->set('properties', $this->Property->find('list'));
			$this->Ptype->recursive = -1;
			$this->set('ptypes', $this->Ptype->find('list'));
			$this->Ctype->recursive = -1;
			$options = array('conditions' => array('type' => 'KHFL'));
			$this->set('ctypes', $this->Ctype->find('list', $options));
		}
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Contact->id = $id;
		if (!$this->Contact->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contact->delete()) {
			$this->Session->setFlash(__('联系记录已删除.'));
		} else {
			$this->Session->setFlash(__('联系记录删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function employee_delete($id = null) {
		$this->Contact->id = $id;
		if (!$this->Contact->exists()) {
			return $this->redirect(array('action' => 'index'));
		}
		$this->Contact->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$contact = $this->Contact->find('first', $options);
		$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
		$date = new DateTime($contact['Contact']['date']);
		if($contact['Contact']['employee_id'] != $this->Auth->user('role_id') || $week_before >= $date){
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contact->delete()) {
			$this->Session->setFlash(__('联系记录已删除.'));
		} else {
			$this->Session->setFlash(__('联系记录删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
