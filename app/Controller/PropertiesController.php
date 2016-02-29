<?php
App::uses('AppController', 'Controller');
/**
 * Properties Controller
 *
 * @property Property $Property
 */
class PropertiesController extends AppController {

    public $uses = array('Property', 'Ptype');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Property->recursive = -1;
		$this->set('properties', $this->Property->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Property->exists($id)) {
			throw new NotFoundException(__('楼盘信息不存在'));
		}
		$this->Property->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'properties_ptypes', 'type' => 'inner',
					'conditions' => 'properties_ptypes.property_id = Property.id'),
				array('table' => 'ptypes', 'alias' => 'Ptype', 'type' => 'inner',
					'conditions' => 'properties_ptypes.ptype_id = Ptype.id')),
			'fields' => array('Property.*', 'Ptype.name'),
			'conditions' => array('Property.id' => $id));
		$properties = $this->Property->find('all', $options);
		$ptypes = '';
		foreach($properties as $property){
			$ptypes .= $property['Ptype']['name'].'<br/>';
		}
		$property = $properties[0];
		$property['Ptype']['name'] = $ptypes;
		$this->set('property', $property);

	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Property->create();
			if ($this->Property->save($this->request->data)) {
				$this->Session->setFlash(__('楼盘信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('楼盘信息保存失败，请稍候再试.'));
			}
		}
		$this->set('ptypes', $this->Ptype->find('list'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Property->exists($id)) {
			throw new NotFoundException(__('楼盘信息不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Property->save($this->request->data)) {
				$this->Session->setFlash(__('楼盘信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('楼盘信息保存失败，请稍候再试.'));
			}
		}else{
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Property->find('first', $options);
		}
		$this->set('ptypes', $this->Ptype->find('list'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Property->id = $id;
		if (!$this->Property->exists()) {
			throw new NotFoundException(__('楼盘信息不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Property->delete()) {
			$this->Session->setFlash(__('楼盘信息已删除.'));
		} else {
			$this->Session->setFlash(__('楼盘信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
