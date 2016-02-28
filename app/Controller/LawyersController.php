<?php
App::uses('AppController', 'Controller');
/**
 * Lawyers Controller
 *
 * @property Lawyer $Lawyer
 */
class LawyersController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Lawyer');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Lawyer->recursive = -1;
		$this->set('lawyers', $this->Lawyer->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Lawyer->exists($id)) {
			throw new NotFoundException(__('律师/律师行信息不存在'));
		}
		$this->Lawyer->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$this->set('lawyer', $this->Lawyer->find('first', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Lawyer->create();
			if ($this->Lawyer->save($this->request->data)) {
				$this->Session->setFlash(__('律师/律师行信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('律师/律师行信息保存失败，请稍候再试.'));
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
		if (!$this->Lawyer->exists($id)) {
			throw new NotFoundException(__('律师/律师行信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Lawyer->save($this->request->data)) {
				$this->Session->setFlash(__('律师/律师行信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('律师/律师行信息保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Lawyer->find('first', $options);
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
		$this->Lawyer->id = $id;
		if (!$this->Lawyer->exists()) {
			throw new NotFoundException(__('律师/律师行信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Lawyer->delete()) {
			$this->Session->setFlash(__('律师/律师行信息已删除.'));
		} else {
			$this->Session->setFlash(__('律师/律师行信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
