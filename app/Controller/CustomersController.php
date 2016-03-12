<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_add','employee_edit', 'employee_index', 
	    		'employee_view');
	    }
    }
    
    public $uses = array('Customer', 'Employee', 'User', 'Suburb', 'Wy', 'Ctype', 'Ptype');

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

	public function employee_index() {
		$this->Customer->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'users', 'alias' => 'User', 'type' => 'left',
						'conditions' => 'Customer.user_id = User.id')),
			'fields' => array('Customer.*','User.username', 'User.active'),
			'conditions' => array('Customer.employee_id' => $this->Auth->user('role_id')));
		$customers = $this->Customer->find('all', $options);
		$this->set('customers', $customers);
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
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		$this->Customer->recursive = -1;
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

	public function employee_view($id = null){
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		$this->Customer->recursive = -1;
		$sql = "SELECT Customer.*, User.username, User.active
				FROM (SELECT Customer.*
						FROM customers AS Customer
						WHERE Customer.id = $id AND Customer.employee_id = ".$this->Auth->user('role_id')." LIMIT 1) 
							AS Customer
				LEFT JOIN users AS User
					ON Customer.user_id = User.id;";
		$customer = $this->Customer->query($sql)[0];
		if(!$customer){
			return $this->redirect(array('action' => 'index'));
		}
		$this->set('customer', $customer);
		$this->set('role', $this->Auth->user('role'));
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
				//-------------------------------Send Notification Email-------------------------------
			}else{
				$this->request->data['Customer']['user_id'] = 0;	
			}

			// Add Customer
			
			$this->request->data['Customer']['date'] = date('Y-m-d H:i:s');
			// suburbs
			$suburb_ids = $this->request->data['Suburb']['Suburb'];
			$suburbs = $this->Suburb->find('list', array('conditions' => array('id' => $suburb_ids)));
			$suburbs_string = '';
			foreach($suburbs as $suburb){
				$suburbs_string .= $suburb.'<br/>';
			}
			$this->request->data['Customer']['suburbs'] = $suburbs_string;
			// wys
			$wy_ids = $this->request->data['Wy']['Wy'];
			$wys = $this->Wy->find('list', array('conditions' => array('id' => $wy_ids)));
			$wys_string = '';
			foreach($wys as $wy){
				$wys_string .= $wy.'<br/>';
			}
			$this->request->data['Customer']['wys'] = $wys_string;
			// ptypes
			$ptype_ids = $this->request->data['Ptype']['Ptype'];
			$ptypes = $this->Ptype->find('list', array('conditions' => array('id' => $ptype_ids)));
			$ptypes_string = '';
			foreach($ptypes as $ptype){
				$ptypes_string .= $ptype.'<br/>';
			}
			$this->request->data['Customer']['ptypes'] = $ptypes_string;
			// cfls
			$ctype_ids = $this->request->data['Ctype']['Ctype'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['cfls'] = $ctypes_string;
			// clys
			$ctype_ids = $this->request->data['Customer']['Ctype2'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['clys'] = $ctypes_string;
			// combine cfl and cly
			foreach($this->request->data['Customer']['Ctype2'] as $ctype){
				array_push($this->request->data['Ctype']['Ctype'], $ctype);
			}

			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				// Add User/role_id
				if($this->request->data['Customer']['user_id']){
					$user_s = array();
					$user_s['User']['id'] = $this->request->data['Customer']['user_id'];
					$user_s['User']['role_id'] = $this->Customer->id;
					$this->User->save($user_s);
				}

				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		}
		$employees = $this->Employee->find('list');
		$employees[0] = '暂不分配';
		$this->set('employees', $employees);
		$this->set('suburbs', $this->Suburb->find('list'));
		$this->set('wys', $this->Wy->find('list'));
		$this->set('cfl', $this->Ctype->find('list', array('conditions' => array('type' => 'KHFL'))));
		$this->set('cly', $this->Ctype->find('list', array('conditions' => array('type' => 'KHLY'))));
		$this->set('ptypes', $this->Ptype->find('list'));

	}

	public function employee_add() {
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
				//-------------------------------Send Notification Email-------------------------------
			}else{
				$this->request->data['Customer']['user_id'] = 0;	
			}

			// Add Customer
			
			$this->request->data['Customer']['date'] = date('Y-m-d H:i:s');
			$this->request->data['Customer']['employee_id'] = $this->Auth->user('role_id');
			// suburbs
			$suburb_ids = $this->request->data['Suburb']['Suburb'];
			$suburbs = $this->Suburb->find('list', array('conditions' => array('id' => $suburb_ids)));
			$suburbs_string = '';
			foreach($suburbs as $suburb){
				$suburbs_string .= $suburb.'<br/>';
			}
			$this->request->data['Customer']['suburbs'] = $suburbs_string;
			// wys
			$wy_ids = $this->request->data['Wy']['Wy'];
			$wys = $this->Wy->find('list', array('conditions' => array('id' => $wy_ids)));
			$wys_string = '';
			foreach($wys as $wy){
				$wys_string .= $wy.'<br/>';
			}
			$this->request->data['Customer']['wys'] = $wys_string;
			// ptypes
			$ptype_ids = $this->request->data['Ptype']['Ptype'];
			$ptypes = $this->Ptype->find('list', array('conditions' => array('id' => $ptype_ids)));
			$ptypes_string = '';
			foreach($ptypes as $ptype){
				$ptypes_string .= $ptype.'<br/>';
			}
			$this->request->data['Customer']['ptypes'] = $ptypes_string;
			// cfls
			$ctype_ids = $this->request->data['Ctype']['Ctype'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['cfls'] = $ctypes_string;
			// clys
			$ctype_ids = $this->request->data['Customer']['Ctype2'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['clys'] = $ctypes_string;
			// combine cfl and cly
			foreach($this->request->data['Customer']['Ctype2'] as $ctype){
				array_push($this->request->data['Ctype']['Ctype'], $ctype);
			}

			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				// Add User/role_id
				if($this->request->data['Customer']['user_id']){
					$user_s = array();
					$user_s['User']['id'] = $this->request->data['Customer']['user_id'];
					$user_s['User']['role_id'] = $this->Customer->id;
					$this->User->save($user_s);
				}

				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		}
		$this->set('suburbs', $this->Suburb->find('list'));
		$this->set('wys', $this->Wy->find('list'));
		$this->set('cfl', $this->Ctype->find('list', array('conditions' => array('type' => 'KHFL'))));
		$this->set('cly', $this->Ctype->find('list', array('conditions' => array('type' => 'KHLY'))));
		$this->set('ptypes', $this->Ptype->find('list'));
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
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {

			// suburbs
			$suburb_ids = $this->request->data['Suburb']['Suburb'];
			$suburbs = $this->Suburb->find('list', array('conditions' => array('id' => $suburb_ids)));
			$suburbs_string = '';
			foreach($suburbs as $suburb){
				$suburbs_string .= $suburb.'<br/>';
			}
			$this->request->data['Customer']['suburbs'] = $suburbs_string;
			// wys
			$wy_ids = $this->request->data['Wy']['Wy'];
			$wys = $this->Wy->find('list', array('conditions' => array('id' => $wy_ids)));
			$wys_string = '';
			foreach($wys as $wy){
				$wys_string .= $wy.'<br/>';
			}
			$this->request->data['Customer']['wys'] = $wys_string;
			// ptypes
			$ptype_ids = $this->request->data['Ptype']['Ptype'];
			$ptypes = $this->Ptype->find('list', array('conditions' => array('id' => $ptype_ids)));
			$ptypes_string = '';
			foreach($ptypes as $ptype){
				$ptypes_string .= $ptype.'<br/>';
			}
			$this->request->data['Customer']['ptypes'] = $ptypes_string;
			// cfls
			$ctype_ids = $this->request->data['Ctype']['Ctype'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['cfls'] = $ctypes_string;
			// clys
			$ctype_ids = $this->request->data['Customer']['Ctype2'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['clys'] = $ctypes_string;
			// combine cfl and cly
			if($this->request->data['Ctype']['Ctype']){
				foreach($this->request->data['Customer']['Ctype2'] as $ctype){
					array_push($this->request->data['Ctype']['Ctype'], $ctype);
				}
			}else{
				$this->request->data['Ctype']['Ctype'] = $this->request->data['Customer']['Ctype2'];
			}
			

			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Customer->recursive = 1;
			$options = array('conditions' => 'Customer.id = '.$id);
			$this->request->data = $this->Customer->find('first', $options);
			$this->set('price_min', $this->request->data['Customer']['price_min']);
			$this->set('price_max', $this->request->data['Customer']['price_max']);
			$cly_selected = array();
			foreach($this->request->data['Ctype'] as $cly){
				if($cly['type'] == 'KHLY'){
					array_push($cly_selected, $cly['id']);
				}
			}
			$this->set('cly_selected', $cly_selected);
		}
		
		$employees = $this->Employee->find('list');
		$employees[0] = '暂不分配';
		$this->set('employees', $employees);
		$this->set('suburbs', $this->Suburb->find('list'));
		$this->set('wys', $this->Wy->find('list'));
		$this->set('cfl', $this->Ctype->find('list', array('conditions' => array('type' => 'KHFL'))));
		$this->set('cly', $this->Ctype->find('list', array('conditions' => array('type' => 'KHLY'))));
		$this->set('ptypes', $this->Ptype->find('list'));
	}

	public function employee_edit($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {

			// suburbs
			$suburb_ids = $this->request->data['Suburb']['Suburb'];
			$suburbs = $this->Suburb->find('list', array('conditions' => array('id' => $suburb_ids)));
			$suburbs_string = '';
			foreach($suburbs as $suburb){
				$suburbs_string .= $suburb.'<br/>';
			}
			$this->request->data['Customer']['suburbs'] = $suburbs_string;
			// wys
			$wy_ids = $this->request->data['Wy']['Wy'];
			$wys = $this->Wy->find('list', array('conditions' => array('id' => $wy_ids)));
			$wys_string = '';
			foreach($wys as $wy){
				$wys_string .= $wy.'<br/>';
			}
			$this->request->data['Customer']['wys'] = $wys_string;
			// ptypes
			$ptype_ids = $this->request->data['Ptype']['Ptype'];
			$ptypes = $this->Ptype->find('list', array('conditions' => array('id' => $ptype_ids)));
			$ptypes_string = '';
			foreach($ptypes as $ptype){
				$ptypes_string .= $ptype.'<br/>';
			}
			$this->request->data['Customer']['ptypes'] = $ptypes_string;
			// cfls
			$ctype_ids = $this->request->data['Ctype']['Ctype'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['cfls'] = $ctypes_string;
			// clys
			$ctype_ids = $this->request->data['Customer']['Ctype2'];
			$ctypes = $this->Ctype->find('list', array('conditions' => array('id' => $ctype_ids)));
			$ctypes_string = '';
			foreach($ctypes as $ctype){
				$ctypes_string .= $ctype.'<br/>';
			}
			$this->request->data['Customer']['clys'] = $ctypes_string;
			// combine cfl and cly
			if($this->request->data['Ctype']['Ctype']){
				foreach($this->request->data['Customer']['Ctype2'] as $ctype){
					array_push($this->request->data['Ctype']['Ctype'], $ctype);
				}
			}else{
				$this->request->data['Ctype']['Ctype'] = $this->request->data['Customer']['Ctype2'];
			}
			

			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('客户信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('客户信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Customer->recursive = 1;
			$options = array('conditions' => array('Customer.id' => $id, 'Customer.employee_id' => $this->Auth->user('role_id')));
			$this->request->data = $this->Customer->find('first', $options);
			if(!$this->request->data){
				return $this->redirect(array('action' => 'index'));
			}
			$this->set('price_min', $this->request->data['Customer']['price_min']);
			$this->set('price_max', $this->request->data['Customer']['price_max']);
			$cly_selected = array();
			foreach($this->request->data['Ctype'] as $cly){
				if($cly['type'] == 'KHLY'){
					array_push($cly_selected, $cly['id']);
				}
			}
			$this->set('cly_selected', $cly_selected);
		}
		
		$this->set('suburbs', $this->Suburb->find('list'));
		$this->set('wys', $this->Wy->find('list'));
		$this->set('cfl', $this->Ctype->find('list', array('conditions' => array('type' => 'KHFL'))));
		$this->set('cly', $this->Ctype->find('list', array('conditions' => array('type' => 'KHLY'))));
		$this->set('ptypes', $this->Ptype->find('list'));
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
