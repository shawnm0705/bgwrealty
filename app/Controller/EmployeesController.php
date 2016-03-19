<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 */
class EmployeesController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_view', 'employee_edit');
	    }
    }
    
    public $uses = array('Employee', 'Team', 'User', 'Customer');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Employee->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'teams', 'alias' => 'Team', 'type' => 'left',
						'conditions' => 'Employee.team_id = Team.id'),
				array('table' => 'users', 'alias' => 'User', 'type' => 'left',
						'conditions' => 'Employee.user_id = User.id')),
			'fields' => array('Employee.*', 'Team.name','User.username', 'User.active'));
		$this->set('employees', $this->Employee->find('all', $options));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('员工信息不存在'));
		}
		$this->Employee->recursive = -1;
		$sql = "SELECT Employee.*, Team.name, User.username, User.active
				FROM (SELECT Employee.*
						FROM employees AS Employee
						WHERE Employee.id = $id LIMIT 1) AS Employee
				LEFT JOIN teams AS Team
					ON Employee.team_id = Team.id
				LEFT JOIN users AS User
					ON Employee.user_id = User.id;";
		$this->set('employee', $this->Employee->query($sql)[0]);
		$options = array('conditions' => array('employee_id' => $id));
		$this->set('customers', $this->Customer->find('list', $options));

	}

	public function employee_view(){
		$id = $this->Auth->user('role_id');
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('个人信息不存在'));
		}
		$this->Employee->recursive = -1;
		$sql = "SELECT Employee.*, Team.name
				FROM (SELECT Employee.*
						FROM employees AS Employee
						WHERE Employee.id = $id LIMIT 1) AS Employee
				LEFT JOIN teams AS Team
					ON Employee.team_id = Team.id;";
		$this->set('employee', $this->Employee->query($sql)[0]);
		$options = array('conditions' => array('employee_id' => $id));
		$this->set('customers', $this->Customer->find('list', $options));
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
				if($this->request->data['Employee']['leader']){
					$user['User']['role'] = 'leader';
				}else{
					$user['User']['role'] = 'employee';
				}
				$user['User']['active'] = 1;
				$this->User->create();
				$this->User->save($user);
				$this->request->data['Employee']['user_id'] = $this->User->id;
				//-------------------------------Send Notification Email-------------------------------
				$to = $user['User']['username'];
				$this->Page->recursive = -1;
				$options = array('conditions' => array('cate' => '新员工注册'));
				$page = $this->Page->find('first', $options);
				$message = $page['Page']['content'];
				$message = preg_replace('/\$USERNAME/', $user['User']['username'], $message);
				$message = preg_replace('/\$PASSWORD/', $user['User']['p_default'], $message);
				$options = array('to' => $to, 'subject' => '创富地产:新用户注册', 'content' => $message);
				$this->email($options);	
			}else{
				$this->request->data['Employee']['user_id'] = 0;	
			}

			// Add Employee
			$dob = $this->request->data['Employee']['dob']['year'].'-'.$this->request->data['Employee']['dob']['month'].'-'.$this->request->data['Employee']['dob']['day'];
			$this->request->data['Employee']['dob'] = $dob;
			$this->request->data['Employee']['date'] = date('Y-m-d H:i:s');
			$this->Employee->create();
			if ($this->Employee->save($this->request->data)) {
				// Team number
				if($this->request->data['Employee']['team_id']){
					$this->Team->recursive = -1;
					$options = array('conditions' => array('id' => $this->request->data['Employee']['team_id']));
					$team = $this->Team->find('first', $options);
					$team['Team']['number'] += 1;
					$this->Team->save($team);
				}

				// Add User/role_id
				if($this->request->data['Employee']['user_id']){
					$user_s = array();
					$user_s['User']['id'] = $this->request->data['Employee']['user_id'];
					$user_s['User']['role_id'] = $this->Employee->id;
					$this->User->save($user_s);
				}

				$this->Session->setFlash(__('员工信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('员工信息保存失败，请稍候再试.'));
			}
		}
		$teams = $this->Team->find('list');
		$teams[0] = '暂不分组';
		$this->set('teams', $teams);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('员工信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Employee->save($this->request->data)) {
				// Team number
				if($this->request->data['Employee']['team_id'] != $this->request->data['Employee']['o_team_id']){
					$this->Team->recursive = -1;
					if($this->request->data['Employee']['team_id']){
						$options = array('conditions' => array('id' => $this->request->data['Employee']['team_id']));
						$team = $this->Team->find('first', $options);
						$team['Team']['number'] += 1;
						$this->Team->save($team);
					}
					if($this->request->data['Employee']['o_team_id']){
						$options = array('conditions' => array('id' => $this->request->data['Employee']['o_team_id']));
						$team = $this->Team->find('first', $options);
						$team['Team']['number'] -= 1;
						$this->Team->save($team);
					}
				}

				// Leader change
				if($this->request->data['Employee']['user_id'] && 
					$this->request->data['Employee']['leader'] != $this->request->data['Employee']['o_leader']){
					$user = array();
					$user['User']['id'] = $this->request->data['Employee']['user_id'];
					if($this->request->data['Employee']['leader']){
						$user['User']['role'] = 'leader';
					}else{
						$user['User']['role'] = 'employee';
					}
					$this->User->save($user);
				}

				$this->Session->setFlash(__('员工信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('员工信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Employee->recursive = -1;
			$options = array('conditions' => 'id = '.$id);
			$this->request->data = $this->Employee->find('first', $options);
			$this->set('team_id', $this->request->data['Employee']['team_id']);
			$this->set('leader', $this->request->data['Employee']['leader']);
			$this->set('user_id', $this->request->data['Employee']['user_id']);
		}
		
		$teams = $this->Team->find('list');
		$teams[0] = '暂不分组';
		$this->set('teams', $teams);
	}

	public function employee_edit() {
		$id = $this->Auth->user('role_id');
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('个人信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('个人信息已保存.'));
				return $this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash(__('个人信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Employee->recursive = -1;
			$options = array('conditions' => 'id = '.$id);
			$this->request->data = $this->Employee->find('first', $options);
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
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			throw new NotFoundException(__('员工信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Employee->delete()) {
			$this->Session->setFlash(__('员工信息已删除.'));
		} else {
			$this->Session->setFlash(__('员工信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
