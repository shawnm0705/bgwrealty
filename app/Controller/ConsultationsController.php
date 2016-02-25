<?php
App::uses('AppController', 'Controller');
/**
 * Consultations Controller
 *
 * @property Consultation $Consultation
 */
class ConsultationsController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow();
    }*/
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Consultation->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'patients', 'conditions' => 'Counsultation.patient_id = patients.id')),
			'conditions' => array('Consultation.doctor_id' => 1));
		$this->set('consultations', $this->Consultation->find('all', $options));
		//$this->set('role', $this->Auth->user('role'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			/*
			$this->Consultation->create();
			if ($this->Consultation->save($this->request->data)) {
				$this->Session->setFlash(__('病例已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('病例保存失败，请稍候再试.'));
			}
		*/
			print_r($this->request->data);
		}
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
		if (!$this->Consultation->exists($id)) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Consultation->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌标签已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌标签保存失败，请稍候再试.'));
			}
		} else {
			$this->Consultation->recursive = -1;
			$sql = "SELECT * FROM poemtags AS Consultation WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Consultation->query($sql)[0];
		}
		$this->set('poemtagcates', $this->Consultation->Consultationcate->find('list'));
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
		$this->Consultation->id = $id;
		if (!$this->Consultation->exists()) {
			throw new NotFoundException(__('诗歌标签不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Consultation->delete()) {
			$this->Session->setFlash(__('诗歌标签已删除.'));
		} else {
			$this->Session->setFlash(__('诗歌标签删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
