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
						'conditions' => 'Customer.employee_id = Employee.id')),
			'fields' => array('Customer.*', 'Employee.name'));
		$this->set('customers', $this->Customer->find('all', $options));
		//$this->set('role', $this->Auth->user('role'));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		}
		$this->set('poemtagcates', $this->Customer->find('list'));
        //$this->set('username',$this->Auth->user('username'));
		//$this->set('role', $this->Auth->user('role'));
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
				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Customer->recursive = -1;
			$sql = "SELECT * FROM poemtags AS Customer WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Customer->query($sql)[0];
		}
		$this->set('poemtagcates', $this->Customer->Customercate->find('list'));
        //$this->set('username',$this->Auth->user('username'));
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
