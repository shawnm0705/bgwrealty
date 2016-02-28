<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/
    
    public $uses = array('Customer', 'Employee', 'User');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Customer->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'employees', 'alias' => 'Employee', 'type' => 'left',
						'conditions' => 'Customer.employee_id = Employee.id'),
				array('table' => 'users', 'alias' => 'User', 'type' => 'left',
						'conditions' => 'Customer.user_id = User.id')),
			'fields' => array('Customer.*', 'Employee.name','User.username', 'User.active'));
		$this->set('customers', $this->Customer->find('all', $options));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		$this->Customer->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'employees', 'alias' => 'Employee', 'type' => 'left',
						'conditions' => 'Customer.employee_id = Employee.id'),
				array('table' => 'users', 'alias' => 'User', 'type' => 'left',
						'conditions' => 'Customer.user_id = User.id')),
			'fields' => array('Customer.*', 'Employee.name','User.username', 'User.active'),
			'conditions' => array('Customer.id' => $id));
		$sql = "SELECT Customer.*, Employee.name, User.username, User.active
				FROM (SELECT Customer.*
						FROM customers AS Customer
						WHERE Customer.id = $id LIMIT 1) AS Customer
				LEFT JOIN employees AS Employee
					ON Customer.employee_id = Employee.id
				LEFT JOIN users AS User
					ON Customer.user_id = User.id;";
		$this->set('customer', $this->Customer->query($sql)[0]);

	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			// Add User
			if($this->request->data['User']['username']){
				$user['User']['username'] = $this->request->data['User']['username'];
				$user['User']['password'] = substr(md5(time()), 0, 8);
				$user['User']['p_default'] = $user['User']['password'];
				$user['User']['role'] = 'customer';
				$user['User']['active'] = 1;
				$this->User->create();
				$this->User->save($user);
				$this->request->data['Customer']['user_id'] = $this->User->id;
			}else{
				$this->request->data['Customer']['user_id'] = 0;	
			}

			// Add Customer
			$dob = $this->request->data['Customer']['dob']['year'].'-'.$this->request->data['Customer']['dob']['month'].'-'.$this->request->data['Customer']['dob']['day'];
			$this->request->data['Customer']['dob'] = $dob;
			$this->request->data['Customer']['date'] = date('Y-m-d H:i:s');
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				// Employee number
				if($this->request->data['Customer']['employee_id']){
					$this->Employee->recursive = -1;
					$options = array('conditions' => array('id' => $this->request->data['Customer']['employee_id']));
					$employee = $this->Employee->find('first', $options);
					$employee['Employee']['number'] += 1;
					$this->Employee->save($employee);
				}

				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		}
		$employees = $this->Employee->find('list');
		$employees[0] = '暂不分组';
		$this->set('employees', $employees);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Customer->save($this->request->data)) {
				// Employee number
				if($this->request->data['Customer']['employee_id'] != $this->request->data['Customer']['o_employee_id']){
					$this->Employee->recursive = -1;
					if($this->request->data['Customer']['employee_id']){
						$options = array('conditions' => array('id' => $this->request->data['Customer']['employee_id']));
						$employee = $this->Employee->find('first', $options);
						$employee['Employee']['number'] += 1;
						$this->Employee->save($employee);
					}
					if($this->request->data['Customer']['o_employee_id']){
						$options = array('conditions' => array('id' => $this->request->data['Customer']['o_employee_id']));
						$employee = $this->Employee->find('first', $options);
						$employee['Employee']['number'] -= 1;
						$this->Employee->save($employee);
					}
				}

				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Customer->recursive = -1;
			$options = array('conditions' => 'id = '.$id);
			$this->request->data = $this->Customer->find('first', $options);
			$this->set('employee_id', $this->request->data['Customer']['employee_id']);
		}
		
		$employees = $this->Employee->find('list');
		$employees[0] = '暂不分组';
		$this->set('employees', $employees);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Customer->delete()) {
			$this->Session->setFlash(__('客户信息已删除.'));
		} else {
			$this->Session->setFlash(__('客户信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
