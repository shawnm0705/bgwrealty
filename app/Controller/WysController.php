<?php
App::uses('AppController', 'Controller');
/**
 * Wys Controller
 *
 * @property Wy $Wy
 */
class WysController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Wy');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Wy->recursive = -1;
		$this->set('wys', $this->Wy->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Wy->exists($id)) {
			throw new NotFoundException(__('物业信息不存在'));
		}
		$this->Wy->recursive = -1;
		$options = array('conditions' => array('id' => $id));
		$this->set('wy', $this->Wy->find('first', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Wy->create();
			if ($this->Wy->save($this->request->data)) {
				$this->Session->setFlash(__('物业信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('物业信息保存失败，请稍候再试.'));
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
		if (!$this->Wy->exists($id)) {
			throw new NotFoundException(__('物业信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Wy->save($this->request->data)) {
				$this->Session->setFlash(__('物业信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('物业信息保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Wy->find('first', $options);
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
		$this->Wy->id = $id;
		if (!$this->Wy->exists()) {
			throw new NotFoundException(__('物业信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Wy->delete()) {
			$this->Session->setFlash(__('物业信息已删除.'));
		} else {
			$this->Session->setFlash(__('物业信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
