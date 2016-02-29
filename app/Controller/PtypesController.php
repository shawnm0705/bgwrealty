<?php
App::uses('AppController', 'Controller');
/**
 * Ptypes Controller
 *
 * @property Ptype $Ptype
 */
class PtypesController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Ptype');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Ptype->recursive = -1;
		$this->set('ptypes', $this->Ptype->find('all'));
	}


/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Ptype->create();
			if ($this->Ptype->save($this->request->data)) {
				$this->Session->setFlash(__('户型信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('户型信息保存失败，请稍候再试.'));
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
		if (!$this->Ptype->exists($id)) {
			throw new NotFoundException(__('户型信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ptype->save($this->request->data)) {
				$this->Session->setFlash(__('户型信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('户型信息保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Ptype->find('first', $options);
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
		$this->Ptype->id = $id;
		if (!$this->Ptype->exists()) {
			throw new NotFoundException(__('户型信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Ptype->delete()) {
			$this->Session->setFlash(__('户型信息已删除.'));
		} else {
			$this->Session->setFlash(__('户型信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
