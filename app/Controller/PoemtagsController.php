<?php
App::uses('AppController', 'Controller');
/**
 * Poemtags Controller
 *
 * @property Poemtag $Poemtag
 */
class PoemtagsController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow();
    }*/
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Poemtag->recursive = -1;
		$sql = "SELECT Poemtag.*, Poemtagcate.name 
				FROM poemtags AS Poemtag
				INNER JOIN poemtagcates AS Poemtagcate
				ON Poemtag.poemtagcate_id=Poemtagcate.id;";
		$this->set('poemtags', $this->Poemtag->query($sql));
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
			$this->Poemtag->create();
			if ($this->Poemtag->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌标签已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌标签保存失败，请稍候再试.'));
			}
		}
		$this->set('poemtagcates', $this->Poemtag->Poemtagcate->find('list'));
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

	public function shortadd() {
		$this->layout = false;
		if ($this->request->is('post')) {
			$this->Poemtag->create();
			if ($this->Poemtag->save($this->request->data)) {
				//$this->Session->setFlash(__('诗歌标签已保存.'));
			} else {
				//$this->Session->setFlash(__('诗歌标签保存失败，请稍候再试.'));
			}
		}
		//$this->set('poemtagcates', $this->Poemtag->Poemtagcate->find('list'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Poemtag->exists($id)) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Poemtag->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌标签已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌标签保存失败，请稍候再试.'));
			}
		} else {
			$this->Poemtag->recursive = -1;
			$sql = "SELECT * FROM poemtags AS Poemtag WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Poemtag->query($sql)[0];
		}
		$this->set('poemtagcates', $this->Poemtag->Poemtagcate->find('list'));
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
		$this->Poemtag->id = $id;
		if (!$this->Poemtag->exists()) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Poemtag->delete()) {
			$this->Session->setFlash(__('诗歌标签已删除.'));
		} else {
			$this->Session->setFlash(__('诗歌标签删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
