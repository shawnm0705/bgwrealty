<?php
App::uses('AppController', 'Controller');
/**
 * Zhenduans Controller
 *
 * @property Zhenduan $Zhenduan
 */
class ZhenduansController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Zhenduan->recursive = -1;
		$this->set('zhenduans', $this->Zhenduan->find('list'));
		//$this->set('role', $this->Auth->user('role'));
	}

	public function lists() {
		$this->layout = false;
		$this->Zhenduan->recursive = -1;
		$zhenduans_list = $this->Zhenduan->find('list');
		$zhenduans = array();
		foreach($zhenduans_list as $val){
			array_push($zhenduans, $val);
		}
		print_r(json_encode($zhenduans));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Zhenduan->create();
			if ($this->Zhenduan->save($this->request->data)) {
				$this->Session->setFlash(__('病例已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('病例保存失败，请稍候再试.'));
			}
		}
		$this->set('poemtagcates', $this->Zhenduan->find('list'));
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
	public function edit($id = null) {
		if (!$this->Zhenduan->exists($id)) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Zhenduan->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌标签已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌标签保存失败，请稍候再试.'));
			}
		} else {
			$this->Zhenduan->recursive = -1;
			$sql = "SELECT * FROM poemtags AS Zhenduan WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Zhenduan->query($sql)[0];
		}
		$this->set('poemtagcates', $this->Zhenduan->Zhenduancate->find('list'));
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
		$this->Zhenduan->id = $id;
		if (!$this->Zhenduan->exists()) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Zhenduan->delete()) {
			$this->Session->setFlash(__('诗歌标签已删除.'));
		} else {
			$this->Session->setFlash(__('诗歌标签删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
