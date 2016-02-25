<?php
App::uses('AppController', 'Controller');
/**
 * Zhengxings Controller
 *
 * @property Zhengxing $Zhengxing
 */
class ZhengxingsController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Zhengxing->recursive = -1;
		$this->set('zhengxings', $this->Zhengxing->find('list'));
		//$this->set('role', $this->Auth->user('role'));
	}

	public function lists() {
		$this->layout = false;
		$this->Zhengxing->recursive = -1;
		$zhengxings_list = $this->Zhengxing->find('list');
		$zhengxings = array();
		foreach($zhengxings_list as $val){
			array_push($zhengxings, $val);
		}
		print_r(json_encode($zhengxings));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Zhengxing->create();
			if ($this->Zhengxing->save($this->request->data)) {
				$this->Session->setFlash(__('病例已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('病例保存失败，请稍候再试.'));
			}
		}
		$this->set('poemtagcates', $this->Zhengxing->find('list'));
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
		if (!$this->Zhengxing->exists($id)) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Zhengxing->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌标签已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌标签保存失败，请稍候再试.'));
			}
		} else {
			$this->Zhengxing->recursive = -1;
			$sql = "SELECT * FROM poemtags AS Zhengxing WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Zhengxing->query($sql)[0];
		}
		$this->set('poemtagcates', $this->Zhengxing->Zhengxingcate->find('list'));
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
		$this->Zhengxing->id = $id;
		if (!$this->Zhengxing->exists()) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Zhengxing->delete()) {
			$this->Session->setFlash(__('诗歌标签已删除.'));
		} else {
			$this->Session->setFlash(__('诗歌标签删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
