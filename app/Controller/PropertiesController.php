<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Properties Controller
 *
 * @property Property $Property
 */
class PropertiesController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('index', 'view');
    }

    public $uses = array('Property', 'Ptype', 'Suburb');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Property->recursive = -1;
		$this->set('properties', $this->Property->find('all'));
	}

	public function index() {
		// Properties
		$this->Property->recursive = -1;
		$options = array('order' => 'id DESC');
		$this->set('price', 100);
		// Filter
		if(isset($this->request->query) && $this->request->query){
			$options['conditions'] = array();
			if($this->request->query['suburb_id']){
				$options['conditions']['suburb_id'] = $this->request->query['suburb_id'];
				$this->request->data['Property']['suburb_id'] = $this->request->query['suburb_id'];
			}
			if($this->request->query['price']){
				$options['conditions']['price_min < '] = $this->request->query['price'];
				$options['conditions']['price_max > '] = $this->request->query['price'];
				$this->set('price', $this->request->query['price']);
			}
			if($this->request->query['ptype_id']){
				$options['joins'] = array(array('table' => 'properties_ptypes', 
					'conditions' => 'properties_ptypes.property_id = Property.id'));
				$options['conditions']['properties_ptypes.ptype_id'] = $this->request->query['ptype_id'];
				$this->request->data['Property']['ptype_id'] = $this->request->query['ptype_id'];
			}
		}
		$properties = $this->Property->find('all', $options);
		$suburbs = $this->Suburb->find('list');
		$ptypes_all = $this->Ptype->find('list');

		// Ptypes
		$this->Ptype->recursive = -1;
		$options = array(
			'joins' => array(
				array('table' => 'properties_ptypes', 'conditions' => 'properties_ptypes.ptype_id = Ptype.id')),
			'fields' => array('Ptype.*', 'properties_ptypes.property_id'));
		$ptypes_list = $this->Ptype->find('all', $options);
		$ptypes = array();
		foreach($ptypes_list as $ptype){
			$property_id = $ptype['properties_ptypes']['property_id'];
			$ptype_name = $ptype['Ptype']['name'];
			if(isset($ptypes[$property_id])){
				$ptypes[$property_id] .= '<br/>'.$ptype_name;
			}else{
				$ptypes[$property_id] = $ptype_name;
			}
		}

		// Slides
		$slides = array();
		foreach($properties as $property){
			$property_id = $property['Property']['id'];
			$dir_path = WWW_ROOT.'img'.DS.'Properties'.DS.$property_id;
			$dir = new Folder($dir_path);
			$slides[$property_id] = $dir->find('.+\..+', true);
		}

		$this->set(compact('ptypes', 'properties','suburbs', 'slides', 'ptypes_all'));
		if($this->Auth->user('role')){
			$this->set('role', $this->Auth->user('role'));
		}
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
					'conditions' => 'properties_ptypes.ptype_id = Ptype.id'),
				array('table' => 'suburbs', 'alias' => 'Suburb', 'type' => 'left',
					'conditions' => 'Property.suburb_id = Suburb.id')),
			'fields' => array('Property.*', 'Ptype.name', 'Suburb.name'),
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

	public function view($id = null){
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
		$suburbs = $this->Suburb->find('list');
		$ptypes_all = $this->Ptype->find('list');

		//Slides
		$dir_path = WWW_ROOT.'img'.DS.'Properties'.DS.$id;
		$dir = new Folder($dir_path);
		$slides = $dir->find('.+\..+', true);
		$this->set(compact('slides', 'property', 'suburbs', 'ptypes_all'));
		if($this->Auth->user('role')){
			$this->set('role', $this->Auth->user('role'));
		}
	}

	public function admin_images($property_id = null){
		$this->layout = false;
		$dir_path = WWW_ROOT.'img'.DS.'Properties'.DS.$property_id;
		$dir = new Folder($dir_path);
		if ($this->request->is('post')) {
			// Upload Img
			$filename = $this->request->data['Image']['photo']['name'];
			if($filename){
				move_uploaded_file($this->request->data['Image']['photo']['tmp_name'], $dir_path.DS.$filename);
			}
		}elseif(isset($this->request->query['image'])){
			// Delete Img
			$file = new File($dir_path.DS.$this->request->query['image']);
			if($file->exists()){
				$file->delete();
			}
		}
		$images = $dir->find('.+\..+', true);
		$this->set(compact('images', 'property_id'));
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
				$dir_path = WWW_ROOT.'img'.DS.'Properties'.DS.$this->Property->id;
				new Folder($dir_path, true, 0755);
				$this->Session->setFlash(__('楼盘信息已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('楼盘信息保存失败，请稍候再试.'));
			}
		}
		$this->set('ptypes', $this->Ptype->find('list'));
		$this->set('suburbs', $this->Suburb->find('list'));
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
		$this->set('suburbs', $this->Suburb->find('list'));
		$this->set('price_min', $this->request->data['Property']['price_min']);
		$this->set('price_max', $this->request->data['Property']['price_max']);
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
			$dir = new Folder(WWW_ROOT.'img'.DS.'Properties'.DS.$id);
			$dir->delete();
			$this->Session->setFlash(__('楼盘信息已删除.'));
		} else {
			$this->Session->setFlash(__('楼盘信息删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
