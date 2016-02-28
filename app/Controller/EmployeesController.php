<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 */
class EmployeesController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/
    
    public $uses = array('Employee', 'Team', 'User');

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
						'conditions' => 'Employee.team_id = Team.id')),
			'fields' => array('Employee.*', 'Team.name'));
		$this->set('employees', $this->Employee->find('all', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			if($this->request->data['User']['username']){
				echo 'yes';
			}

			$dob = $this->request->data['Employee']['dob']['year'].'-'.$this->request->data['Employee']['dob']['month'].'-'.$this->request->data['Employee']['dob']['day'];
			$this->request->data['Employee']['dob'] = $dob;
			$this->request->data['Employee']['date'] = date('Y-m-d H:i:s');
			print_r($this->request->data);
			/*$this->Employee->create();
			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('员工信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('员工信息保存失败，请稍候再试.'));
			}*/
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
				$this->Session->setFlash(__('员工信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('员工信息保存失败，请稍候再试.'));
			}
		} else {
			$this->Employee->recursive = -1;
			$sql = "SELECT * FROM poemtags AS Employee WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Employee->query($sql)[0];
		}
		$this->set('poemtagcates', $this->Employee->Employeecate->find('list'));
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
