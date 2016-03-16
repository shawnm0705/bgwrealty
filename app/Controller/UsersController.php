<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * This controller use a model
 *
 * @var array
 */
	public $uses = array('User', 'Customer', 'Employee', 'Page', 'Suburb', 'Ptype');

/**
 * login logout method
 *
 * @return void
 */
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to login and logout.
	    $this->Auth->allow('login', 'logout', 'check', 'register', 'resetpassword');
	    if($this->Auth->user('role')){
	    	$this->Auth->allow('home', 'changepassword');
	    }
	}

	public function login() {
		if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	if($this->Auth->user('active')){
		        	if($this->Auth->user('role') == 'admin'){
		        		return $this->redirect(array('admin' => true, 'controller' => 'pages', 'action' => 'home'));
		        	}elseif($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
		        		return $this->redirect(array('employee' => true, 'controller' => 'pages', 'action' => 'home'));
		        	}else{
			            return $this->redirect($this->Auth->redirectUrl());
			        }
			    }else{
			    	$this->Session->setFlash(__('帐户未激活.'));
			    	$this->redirect(array('controller' => 'users', 'action' => 'logout'));
			    }
	        }
	        $this->Session->setFlash(__('用户名或密码错误!'));
	    }
        return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
	}

	public function admin_login() {
        return $this->redirect(array('admin' => false, 'controller' => 'pages', 'action' => 'home'));
	}
	public function employee_login() {
        return $this->redirect(array('employee' => false, 'controller' => 'pages', 'action' => 'home'));
	}
	public function customer_login() {
        return $this->redirect(array('customer' => false, 'controller' => 'pages', 'action' => 'home'));
	}

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	public function register() {
		if ($this->request->is('post')) {
			$email = $this->request->data['Customer']['email'];
			// Checks
			if(!$this->request->data['Customer']['name'] || !$this->request->data['Customer']['email'] || 
				!$this->request->data['Customer']['purpose'] || !$this->request->data['Customer']['phone']){
				$this->Session->setFlash(__('*必填项不能为空'));
			}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$this->Session->setFlash(__('E-mail 格式错误！'));
			}elseif($this->request->data['Customer']['price_min'] && 
				!filter_var($this->request->data['Customer']['price_min'], FILTER_SANITIZE_NUMBER_INT) || 
				$this->request->data['Customer']['price_max'] &&
				!filter_var($this->request->data['Customer']['price_max'], FILTER_SANITIZE_NUMBER_INT)){
				$this->Session->setFlash(__('意向价格只能为纯数字！'));
			}elseif($this->check($email)){
				$this->Session->setFlash(__('用户名已存在！'));
			}else{
				// Add User account
				$user['User']['username'] = $email;
				$user['User']['password'] = substr(md5(time()), 0, 8);
				$user['User']['p_default'] = $user['User']['password'];
				$user['User']['role'] = 'customer';
				$user['User']['active'] = 1;
				$this->User->create();
				$this->User->save($user);
				$this->request->data['Customer']['user_id'] = $this->User->id;
				//-------------------------------Send Notification Email-------------------------------
				$to = $user['User']['username'];
				$this->Page->recursive = -1;
				$options = array('conditions' => array('cate' => '新客户注册'));
				$page = $this->Page->find('first', $options);
				$message = $page['Page']['content'];
				preg_replace('/\$USERNAME/', $user['User']['username'], $message);
				preg_replace('/\$PASSWORD/', $user['User']['p_default'], $message);
				$options = array('to' => $to, 'subject' => '创富地产:新用户注册', 'content' => $message);
				$this->email($options);	

				// Add Customer
				$this->request->data['Customer']['date'] = date('Y-m-d H:i:s');
				$this->request->data['Customer']['employee_id'] = 0;
				// suburbs
				$suburb_ids = $this->request->data['Suburb']['Suburb'];
				$suburbs = $this->Suburb->find('list', array('conditions' => array('id' => $suburb_ids)));
				$suburbs_string = '';
				foreach($suburbs as $suburb){
					$suburbs_string .= $suburb.'<br/>';
				}
				$this->request->data['Customer']['suburbs'] = $suburbs_string;
				// ptypes
				$ptype_ids = $this->request->data['Ptype']['Ptype'];
				$ptypes = $this->Ptype->find('list', array('conditions' => array('id' => $ptype_ids)));
				$ptypes_string = '';
				foreach($ptypes as $ptype){
					$ptypes_string .= $ptype.'<br/>';
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
					$this->Session->setFlash(__('账号已注册,请查看邮件获取初始密码.'));
					return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
				} else {
					$this->Session->setFlash(__('账号注册失败，请稍候再试.'));
				}
			}
		}
		$this->set('suburbs', $this->Suburb->find('list'));
		$this->set('ptypes', $this->Ptype->find('list'));
	}

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$options = array('to' => 'mx_198891@163.com', 'subject' => 'Test', 'content' => 'Just for test');
		$this->email($options);
		//=======================================
		$this->User->recursive = -1;
		$this->set('users', $this->User->find('all'));
		$this->Employee->recursive = -1;
		$this->set('employees', $this->Employee->find('list'));
		$this->Customer->recursive = -1;
		$this->set('customers', $this->Customer->find('list'));
		$this->set('roles', array('admin' => '管理员', 'customer' => '客户', 'employee' => '员工', 'leader' => '组长'));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add($role = null) {
		if(!$role){
			return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}
		if ($this->request->is('post')) {
			// Username check
			if($this->check($this->request->data['User']['username'])){
				$this->Session->setFlash(__('用户名已存在！'));
				return $this->redirect(array('action' => 'add'));
			}else{
				// p_default
				if($role == 'admin'){
					$this->request->data['User']['p_default'] = $this->request->data['User']['password'];
					$this->request->data['User']['role_id'] = 0;
				}else{
					$this->request->data['User']['password'] = substr(md5(time()), 0, 8);
					$this->request->data['User']['p_default'] = $this->request->data['User']['password'];
					$this->request->data['User']['role_id'] = $this->request->data['User']['people_id'];
				}
				if($role == 'employee'){
					$this->Employee->recursive = -1;
					$options = array('conditions' => 'id = '.$this->request->data['User']['people_id']);
					$employee = $this->Employee->find('first', $options);
					if($employee['Employee']['leader']){
						$this->request->data['User']['role'] = 'leader';
					}else{
						$this->request->data['User']['role'] = $role;
					}
				}else{
					$this->request->data['User']['role'] = $role;
				}
				$this->request->data['User']['active'] = 1;
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					// Save user_id to Customer/Employee
					if($role == 'customer'){
						$customer = array();
						$customer['Customer']['id'] = $this->request->data['User']['people_id'];
						$customer['Customer']['user_id'] = $this->User->id;
						$this->Customer->save($customer);
					}elseif($role == 'employee'){
						$employee = array();
						$employee['Employee']['id'] = $this->request->data['User']['people_id'];
						$employee['Employee']['user_id'] = $this->User->id;
						$this->Employee->save($employee);
					}
					//-------------------------------Send Notification Email-------------------------------
					if($role != 'admin'){
						$to = $this->request->data['User']['username'];
						$this->Page->recursive = -1;
						$options = array('conditions' => array('cate' => '新客户注册'));
						$page = $this->Page->find('first', $options);
						$message = $page['Page']['content'];
						preg_replace('/\$USERNAME/', $this->request->data['User']['username'], $message);
						preg_replace('/\$PASSWORD/', $this->request->data['User']['p_default'], $message);
						$options = array('to' => $to, 'subject' => '创富地产:新用户注册', 'content' => $message);
						$this->email($options);		
					}

					$this->Session->setFlash(__('账号信息已保存.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('账号信息保存失败，请稍候再试.'));
					return $this->redirect(array('action' => 'add'));
				}
			}
		}
		if($role == 'customer'){
			$this->Customer->recursive = -1;
			$options = array('conditions' => 'user_id = 0');
			$customers_list = $this->Customer->find('all', $options);
			$people = array();
			foreach($customers_list as $customer){
				$id = $customer['Customer']['id'];
				$name = $customer['Customer']['name'];
				if($customer['Customer']['gender']){
					$gender = '男';
				}else{
					$gender = '女';
				}
				$date = $customer['Customer']['date'];
				$people[$id] = $name.'  '.$gender.'  '.$date;
			}
			$this->set('people', $people);
		}elseif($role == 'employee'){
			$this->Employee->recursive = -1;
			$options = array('conditions' => 'user_id = 0');
			$employees_list = $this->Employee->find('all', $options);
			$people = array();
			foreach($employees_list as $employee){
				$id = $employee['Employee']['id'];
				$name = $employee['Employee']['name'];
				if($employee['Employee']['gender']){
					$gender = '男';
				}else{
					$gender = '女';
				}
				$date = $employee['Employee']['date'];
				$people[$id] = $name.'  '.$gender.'  '.$date;
			}
			$this->set('people', $people);
		}
		$this->set('role', $role);
	}

	public function check($username = null){
		$this->layout = false;
		$this->User->recursive = -1;
		if($username){
			if (!empty($this->request->query['user_id'])) {
				$user_id = $this->request->query['user_id'];
				$options = array('conditions' => array('User.username' => $username, 'User.id !=' => $user_id));
			}else{
				$options = array('conditions' => array('User.username' => $username));
			}
			if($this->User->find('first', $options)){
				echo '<font color="red">用户名已存在！</font>';
				return 1;
			}else{
				echo '<font color="green">用户名可用</font>';
				return 0;
			}
		}
		$this->render('empty');
	}

	public function admin_check($username = null){
		return $this->redirect(array('admin' => false, 'action' => 'check', $username));
	}

	public function admin_active($id = null){
		$this->layout = false;
		$user = array();
		$user['User']['id'] = $id;
		if($this->request->query['status']){
			$user['User']['active'] = 0;
		}else{
			$user['User']['active'] = 1;
		}
		$this->User->save($user);
		if($user['User']['active']){
			echo '已激活<a href="#active" class="btn btn-custom button-small" onclick="active('.$id.',1)" id="btn-active">修改激活状态</a>';
		}else{
			echo '未激活<a href="#active" class="btn btn-custom button-small" onclick="active('.$id.',0)" id="btn-active">修改激活状态</a>';

		}
		$this->render('empty');
	}

	public function resetpassword($id = null){
		if($this->Auth->user('role') == 'admin'){
			if($this->request->query['role'] == 'employee'){
				$options = array('conditions' => array('role_id' => $id, 'role' => array('employee', 'leader')));
			}else{
				$options = array('conditions' => array('role_id' => $id, 'role' => 'customer'));
			}
			$this->User->recursive = -1;
			$user = $this->User->find('first', $options);
			$user['User']['password'] = $user['User']['p_default'];
			$this->User->save($user);
			$this->Session->setFlash(__('密码已重置.'));

			//-------------------------------Send Notification Email-------------------------------
			$this->Page->recursive = -1;
			if($this->request->query['role'] == 'employee'){
				$options = array('conditions' => array('cate' => '员工重置密码'));
			}else{
				$options = array('conditions' => array('cate' => '客户重置密码'));
			}
			$page = $this->Page->find('first', $options);
			$message = $page['Page']['content'];
			preg_replace('/\$USERNAME/', $user['User']['username'], $message);
			preg_replace('/\$PASSWORD/', $user['User']['p_default'], $message);
			$options = array('to' => $user['User']['username'], 'subject' => '创富地产:重置密码', 'content' => $message);
			$this->email($options);
			if($this->request->query['role'] == 'employee'){
				return $this->redirect(array('admin' => true, 'controller' => 'employees', 'action' => 'view', $id));
			}else{
				return $this->redirect(array('admin' => true, 'controller' => 'customers', 'action' => 'view', $id));
			}
		}
	}

	public function changepassword(){
		if ($this->request->is('post')) {
			$password1 = $this->request->data['User']['password1'];
			$password2 = $this->request->data['User']['password2'];
			if($password1 != $password2){
				$this->Session->setFlash(__('两次密码不一致！'));
			}else{
				$user['User']['id'] = $this->Auth->user('id');
				$user['User']['password'] = $password1;
				$this->User->save($user);
				$this->Session->setFlash(__('密码已修改.'));
				if($this->Auth->user('role') == 'customer'){
					return $this->redirect(array('customer' => true, 'controller' => 'customers', 'action' => 'view'));
				}else{
					return $this->redirect(array('employee' => true, 'controller' => 'employees', 'action' => 'view'));
				}
			}
		}
		$this->set('role', $this->Auth->user('role'));
		$this->set('username', $this->Auth->user('username'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('不存在该账号'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->User->recursive = -1;
		$user = $this->User->find('first', array('conditions' => 'id = '.$id));
		if ($this->User->delete()) {
			// change Employee/Customer user_id
			if($user['User']['role'] == 'customer'){
				$customer['Customer']['id'] = $user['User']['role_id'];
				$customer['Customer']['user_id'] = 0;
				$this->Customer->save($customer);
			}elseif($user['User']['role'] == 'employee' || $user['User']['role'] == 'leader'){
				$employee['Employee']['id'] = $user['User']['role_id'];
				$employee['Employee']['user_id'] = 0;
				$this->Employee->save($employee);
			}
			$this->Session->setFlash(__('账号已删除.'));
		} else {
			$this->Session->setFlash(__('账号删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
