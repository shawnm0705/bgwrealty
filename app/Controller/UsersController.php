<?php
App::uses('AppController', 'Controller');
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
	public $uses = array('User', 'Customer', 'Employee');

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
	    	$this->Auth->allow('home');
	    }
	}

	public function login() {
		if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	if($this->Auth->user('active')){
		        	if($this->Auth->user('role') == 'admin'){
		        		return $this->redirect(array('admin' => true, 'controller' => 'pages', 'action' => 'home'));
		        	}elseif($this->Auth->user('role') == 'employee'){
		        		return $this->redirect(array('employee' => true, 'controller' => 'pages', 'action' => 'home'));
		        	}else{
			            return $this->redirect($this->Auth->redirectUrl());
			        }
			    }else{
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

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	public function register() {
		if ($this->request->is('post')) {
			if($this->check($this->request->data['User']['username'])){
				$this->Session->setFlash(__('用户名已存在！'));
				return $this->redirect(array('action' => 'register'));
			}else{
				$password1 = $this->request->data['User']['password1'];
				$password2 = $this->request->data['User']['password2'];
				if($password1 != $password2){
					$this->Session->setFlash(__('两次密码不一致！'));
					return $this->redirect(array('action' => 'register'));
				}else{
					$this->User->create();
					$this->request->data['User']['password'] = $this->request->data['User']['password1'];
					$this->request->data['User']['role'] = 'customer';
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash(__('账号已注册.'));
						return $this->redirect(array('action' => 'login'));
					} else {
						$this->Session->setFlash(__('账号注册失败，请稍候再试.'));
						return $this->redirect(array('action' => 'register'));
					}
				}
			}
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
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
