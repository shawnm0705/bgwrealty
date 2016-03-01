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
	public $uses = array('User');

/**
 * login logout method
 *
 * @return void
 */
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to login and logout.
	    $this->Auth->allow('login', 'logout', 'check', 'register', 'findpassword');
	    if($this->Auth->user('role')){
	    	$this->Auth->allow('home');
	    }
	}

	/*public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Session->setFlash(__('用户名或密码错误!'));
	    }
	}*/

	public function home(){		
		
		$this->set('role',$this->Auth->user('role'));
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
	public function index() {
		$this->User->recursive = -1;
		$this->set('users', $this->User->find('all'));
		$this->set('roles', array('admin' => '管理员', 'customer' => '用户'));
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout = false;
		$this->User->recursive = -1;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('不存在该账号'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		$this->set('roles', $this->ROLES);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if($this->check($this->request->data['User']['username'])){
				$this->Session->setFlash(__('用户名已存在！'));
				return $this->redirect(array('action' => 'add'));
			}else{
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('账号信息已保存.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('账号信息保存失败，请稍候再试.'));
					return $this->redirect(array('action' => 'add'));
				}
			}
		}
		$this->set('roles', $this->ROLES);
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->recursive = -1;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('不存在该账号'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('账号信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('账号信息保存失败，请稍候再试.'));
				return $this->redirect(array('action' => 'edit', $id));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			$this->set('user', $this->request->data);
			$this->set('user_id', $id);
		}
		$this->set('roles', $this->ROLES);
		$this->set('role', $this->Auth->user('role'));
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
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('不存在该账号'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('账号已删除.'));
		} else {
			$this->Session->setFlash(__('账号删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
