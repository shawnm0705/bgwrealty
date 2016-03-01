<?php
App::uses('AppController', 'Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 */
class TeamsController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Team', 'Employee');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Team->recursive = -1;
		$this->set('teams', $this->Team->find('all'));
		//$this->set('role', $this->Auth->user('role'));
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

        //$this->set('username',$this->Auth->user('username'));
		//$this->set('role', $this->Auth->user('role'));
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
