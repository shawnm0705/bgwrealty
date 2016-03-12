<?php
App::uses('AppController', 'Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 */
class TeamsController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'leader'){
			$this->Auth->allow('employee_myteam', 'employee_teammate', 'employee_teamcustomer');
		}
    }

    public $uses = array('Team', 'Employee', 'Customer');

    
    public function employee_myteam(){
    	$id = $this->Auth->user('role_id');
    	$this->Employee->recursive = -1;
    	$options = array(
    		'joins' => array(
    			array('table' => 'teams', 'alias' => 'Team', 'conditions' => 'Team.id = Employee.team_id')),
    		'conditions' => 'Employee.id = '.$id,
    		'fields' => array('Team.*', 'Employee.id'));
    	$me = $this->Employee->find('first', $options);
    	$this->set('me', $me);
    	$team_id = $me['Team']['id'];
    	$options = array('conditions' => 'team_id = '.$team_id);
    	$this->set('employees', $this->Employee->find('all', $options));
    }

    public function employee_teammate($id = null){
    	if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('成员信息不存在'));
		}
		if(!isset($this->request->query['team_id']) || !$this->request->query['team_id']){
			return $this->redirect(array('action' => 'myteam'));
		}
		$this->Employee->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'team_id' => $this->request->query['team_id']));
		$employee = $this->Employee->find('first', $options);
		if(!$employee){
			return $this->redirect(array('action' => 'myteam'));	
		}
		$this->set('employee', $employee);
		$options = array('conditions' => array('employee_id' => $id));
		$this->set('customers', $this->Customer->find('list', $options));
    }

    public function employee_teamcustomer($id = null){
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('客户信息不存在'));
		}
		$employee_id = $this->request->query['e_id'];
		$this->Customer->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'employee_id' => $employee_id));
		$customer = $this->Customer->find('first', $options);
		if(!$customer){
			return $this->redirect(array('action' => 'myteam'));
		}
		$this->set('customer', $customer);
	}

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Team->recursive = -1;
		$this->set('teams', $this->Team->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('团队信息不存在'));
		}
		$this->Team->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$this->set('team', $this->Team->find('first', $options));
		$options = array('conditions' => array('team_id' => $id));
		$this->set('employees', $this->Employee->find('all', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Team']['number'] = 0;
			$this->Team->create();
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('团队信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('团队信息保存失败，请稍候再试.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('团队信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('团队信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('团队信息保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Team->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('团队信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('团队信息已删除.'));
		} else {
			$this->Session->setFlash(__('团队信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
