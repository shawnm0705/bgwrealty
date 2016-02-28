<?php
App::uses('AppController', 'Controller');
/**
 * Suburbs Controller
 *
 * @property Suburb $Suburb
 */
class SuburbsController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Suburb');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Suburb->recursive = -1;
		$this->set('suburbs', $this->Suburb->find('all'));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Suburb->create();
			if ($this->Suburb->save($this->request->data)) {
				$this->Session->setFlash(__('区域信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('区域信息保存失败，请稍候再试.'));
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
		if (!$this->Suburb->exists($id)) {
			throw new NotFoundException(__('区域信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Suburb->save($this->request->data)) {
				$this->Session->setFlash(__('区域信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('区域信息保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Suburb->find('first', $options);
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
		$this->Suburb->id = $id;
		if (!$this->Suburb->exists()) {
			throw new NotFoundException(__('区域信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Suburb->delete()) {
			$this->Session->setFlash(__('区域信息已删除.'));
		} else {
			$this->Session->setFlash(__('区域信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
