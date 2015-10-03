<?php
App::uses('AppController', 'Controller');
/**
 * Poemcates Controller
 *
 * @property Poemcate $Poemcate
 */
class PoemcatesController extends AppController {

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
		$this->Poemcate->recursive = -1;
		$sql = "SELECT * FROM poemcates AS Poemcate;";
		$this->set('poemcates', $this->Poemcate->query($sql));
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
			$this->Poemcate->create();
			if ($this->Poemcate->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌类别已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌类别保存失败，请稍候再试.'));
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
		if (!$this->Poemcate->exists($id)) {
			throw new NotFoundException(__('诗歌类别不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Poemcate->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌类别已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌类别保存失败，请稍候再试.'));
			}
		} else {
			$this->Poemcate->recursive = -1;
			$sql = "SELECT * FROM poemcates AS Poemcate WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Poemcate->query($sql)[0];
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
		$this->Poemcate->id = $id;
		if (!$this->Poemcate->exists()) {
			throw new NotFoundException(__('诗歌类别不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Poemcate->delete()) {
			$this->Session->setFlash(__('诗歌类别已删除.'));
		} else {
			$this->Session->setFlash(__('诗歌类别删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
