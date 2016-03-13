<?php
App::uses('AppController', 'Controller');
/**
 * Guidances Controller
 *
 * @property Guidance $Guidance
 */
class GuidancesController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'employee' || $this->Auth->user('role') == 'leader'){
	    	$this->Auth->allow('employee_index');
	    }
		if($this->Auth->user('role') == 'leader'){
			$this->Auth->allow('employee_add', 'employee_edit', 'employee_delete');
		}
    }

    public $uses = array('Guidance', 'Employee', 'Customer');

    
    public function employee_index(){
    	$role = $this->Auth->user('role');
    	$employee_id = $this->Auth->user('role_id');
    	if($role == 'employee'){
	    	$this->Guidance->recursive = 0;
    		$options = array('conditions' => array('Guidance.employee_id' => $employee_id));
    	}else{
    		$this->Employee->recursive = -1;
    		$options = array('conditions' => array('id' => $employee_id));
    		$me = $this->Employee->find('first', $options);
    		$team_id = $me['Employee']['team_id'];
	    	$this->Guidance->recursive = -1;
    		$options = array(
    			'joins' => array(
    				array('table' => 'employees', 'alias' => 'Employee', 'conditions' => 'Guidance.employee_id = Employee.id'),
    				array('table' => 'customers', 'alias' => 'Customer', 'conditions' => 'Guidance.customer_id = Customer.id')),
    			'conditions' => array('Employee.team_id' => $team_id),
    			'fields' => array('Guidance.*', 'Customer.name', 'Employee.name', 'Employee.id'),
    			'group' => array('Employee.name'));
    	}
		$this->set('guidances', $this->Guidance->find('all', $options));
    	$this->set('role', $role);
    }

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Guidance->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'employees', 'alias' => 'Employee', 'conditions' => 'Guidance.employee_id = Employee.id'),
				array('table' => 'customers', 'alias' => 'Customer', 'conditions' => 'Guidance.customer_id = Customer.id'),
				array('table' => 'teams', 'alias' => 'Team', 'conditions' => 'Employee.team_id = Team.id')),
			'fields' => array('Guidance.*', 'Customer.name', 'Employee.name', 'Team.name'),
			'group' => array('Team.name', 'Employee.name'));
		$this->set('guidances', $this->Guidance->find('all', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function employee_add($employee_id = null) {
		if(!$employee_id || !isset($this->request->query['team_id'])){
			return $this->redirect(array('controller' => 'teams', 'action' => 'myteam'));
		}
		$team_id = $this->request->query['team_id'];
		$this->Employee->recursive = -1;
		$options = array('conditions' => array('id' => $employee_id, 'team_id' => $team_id));
		$employee = $this->Employee->find('first', $options);
		if(!$employee){
			return $this->redirect(array('controller' => 'teams', 'action' => 'myteam'));
		}
		$this->set('employee', $employee);
		if ($this->request->is('post')) {
			$this->Guidance->recursive = -1;
			$customer_id = $this->request->data['Guidance']['customer_id'];
			$guidance = $this->Guidance->find('first', array('conditions' => 'customer_id = '.$customer_id));
			if($guidance){
				$this->request->data['Guidance']['id'] = $guidance['Guidance']['id'];
			}else{
				$this->Guidance->create();
			}
			if ($this->Guidance->save($this->request->data)) {
				$this->Session->setFlash(__('指导方案已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('指导方案保存失败，请稍候再试.'));
			}
		}
		$this->Customer->recursive = -1;
		$options = array('conditions' => 'employee_id = '.$employee_id);
		$this->set('customers', $this->Customer->find('list', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function employee_edit($id = null) {
		if(!$id || !isset($this->request->query['employee_id'])){
			return $this->redirect(array('action' => 'index'));
		}
		$employee_id = $this->request->query['employee_id'];
		$this->Guidance->recursive = -1;
		$options = array('conditions' => array('id' => $id, 'employee_id' => $employee_id));
		$guidance = $this->Guidance->find('first', $options);
		if(!$guidance){
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Guidance->save($this->request->data)) {
				$this->Session->setFlash(__('指导方案已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('指导方案保存失败，请稍候再试.'));
			}
		}else{
			$this->request->data = $guidance;
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
		$this->Guidance->id = $id;
		if (!$this->Guidance->exists()) {
			throw new NotFoundException(__('指导方案不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Guidance->delete()) {
			$this->Session->setFlash(__('指导方案已删除.'));
		} else {
			$this->Session->setFlash(__('指导方案删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
