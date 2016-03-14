<?php
App::uses('AppController', 'Controller');
/**
 * Feedbacks Controller
 *
 * @property Feedback $Feedback
 */
class FeedbacksController extends AppController {

	public function beforeFilter() {
		if($this->Auth->user('role') == 'customer'){
			$this->Auth->allow('customer_view', 'customer_edit');
		}
    }

    public $uses = array('Feedback');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Feedback->recursive = 0;
		$this->set('feedbacks', $this->Feedback->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('客户反馈不存在'));
		}
		$this->Feedback->recursive = 0;
		$options = array('conditions' => array('id' => $id));
		$this->set('feedback', $this->Feedback->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function customer_view() {
		$this->Feedback->recursive = -1;
		$options = array('conditions' => array('customer_id' => $this->Auth->user('role_id')));
		$feedback = $this->Feedback->find('first', $options);
		if(!$feedback){
			$feedback = array('Feedback' => array('rate_e' => '无', 'rate_dk' => '无', 'rate_wy' => '无', 'content' => '无'));
		}
		$this->set('feedback', $feedback);

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function customer_edit() {
		if ($this->request->is(array('post', 'put'))) {
			if(!isset($this->request->data['Feedback']['id'])){
				$this->Feedback->create();
				$this->request->data['Feedback']['customer_id'] = $this->Auth->user('role_id');
			}
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('反馈已保存.'));
				return $this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash(__('反馈保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('customer_id' => $this->Auth->user('role_id')));
			$this->request->data = $this->Feedback->find('first', $options);
			if($this->request->data){
				$this->set('id', 1);
			}
		}
		$this->set('rates', array('很好' => '很好', '好' => '好', '一般' => '一般', '差' => '差', '很差' => '很差'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('客户反馈不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Feedback->delete()) {
			$this->Session->setFlash(__('客户反馈已删除.'));
		} else {
			$this->Session->setFlash(__('客户反馈删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
