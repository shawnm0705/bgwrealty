<?php
App::uses('AppController', 'Controller');
/**
 * Ctypes Controller
 *
 * @property Ctype $Ctype
 */
class CtypesController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Ctype');

/**
 * index method
 *
 * @return void
 */
	public function admin_index($type = null) {
		if($type){
			$this->Ctype->recursive = -1;
			$options = array('conditions' => array('type' => $type));
			$this->set('ctypes', $this->Ctype->find('all', $options));
			$this->set('type', $type);
		}else{
			return $this->redirect(array('controller' =>'pages', 'action' => 'home'));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add($type = null) {
		if ($this->request->is('post')) {
			$this->Ctype->create();
			if ($this->Ctype->save($this->request->data)) {
				$this->Session->setFlash(__('用户分类已保存.'));
				return $this->redirect(array('action' => 'index', $type));
			} else {
				$this->Session->setFlash(__('用户分类保存失败，请稍候再试.'));
			}
		}elseif(!$type){
			return $this->redirect(array('controller' =>'pages', 'action' => 'home'));
		}
		$this->set('type', $type);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Ctype->exists($id)) {
			throw new NotFoundException(__('用户分类不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ctype->save($this->request->data)) {
				$this->Session->setFlash(__('用户分类已保存.'));
				return $this->redirect(array('action' => 'index', $this->request->data['Ctype']['type']));
			} else {
				$this->Session->setFlash(__('用户分类保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Ctype->find('first', $options);
		}
		$this->set('type', $this->request->data['Ctype']['type']);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Ctype->id = $id;
		if (!$this->Ctype->exists()) {
			throw new NotFoundException(__('用户分类不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Ctype->delete()) {
			$this->Session->setFlash(__('用户分类已删除.'));
		} else {
			$this->Session->setFlash(__('用户分类删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
