<?php
App::uses('AppController', 'Controller');
/**
 * Poemtagcates Controller
 *
 * @property Poemtagcate $Poemtagcate
 */
class PoemtagcatesController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow();
    }
	*/
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Poemtagcate->recursive = -1;
		$sql = "SELECT * FROM poemtagcates AS Poemtagcate;";
		$this->set('poemtagcates', $this->Poemtagcate->query($sql));
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Poemtagcate->create();
			if ($this->Poemtagcate->save($this->request->data)) {
				$this->Session->setFlash(__('标签类别已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('标签类别保存失败，请稍候再试.'));
			}
		}
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Poemtagcate->exists($id)) {
			throw new NotFoundException(__('标签类别不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Poemtagcate->save($this->request->data)) {
				$this->Session->setFlash(__('标签类别已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('标签类别保存失败，请稍候再试.'));
			}
		} else {
			$this->Poemtagcate->recursive = -1;
			$sql = "SELECT * FROM poemtagcates AS Poemtagcate WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Poemtagcate->query($sql)[0];
		}
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Poemtagcate->id = $id;
		if (!$this->Poemtagcate->exists()) {
			throw new NotFoundException(__('标签类别不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Poemtagcate->delete()) {
			$this->Session->setFlash(__('标签类别已删除.'));
		} else {
			$this->Session->setFlash(__('标签类别删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
