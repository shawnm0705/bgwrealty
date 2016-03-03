<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class PagesController extends AppController {
	
	public function beforeFilter() {
		$this->Auth->allow('home', 'display');
    }
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Page','Article', 'Suburb');
	public $PAGES_LIST = array('about' => '公司简介', 'info' => '公司资讯', 'contact' => '联系我们', 'join' => '加入我们');

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	
	public function home(){
	    // Slides
		$dir = new Folder(WWW_ROOT.'img'.DS.'Slides'.DS);
		$files = $dir->find('.+\..+', true);
		$this->set('slides', $files);
		// Articles
		$types = array('YNDT', 'SCSJ', 'ZCXX', 'SZGH', 'JJDT');
		$options = array(
			'conditions' => array('type' => $types, 'status' => 'APPROVAL'),
			'order' => 'date DESC');
		$this->Article->recursive = -1;
		$articles_list = $this->Article->find('all', $options);
		$articles = array();
		foreach($articles_list as $article){
			$type = $article['Article']['type'];
			if(isset($articles[$type])){
				array_push($articles[$type], $article);
			}else{
				$articles[$type][0] = $article;
			}
		}
		$suburbs = $this->Suburb->find('list');
		$this->set(compact('articles', 'suburbs'));
		$this->set('types_list', array(
	    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'));
	}

	public function admin_home(){
				
	}

	public function admin_slides($img = null){
		$dir_path = WWW_ROOT.'img'.DS.'Slides'.DS;
		$dir = new Folder($dir_path);
		if ($this->request->is('post')) {
			// Upload Img
			$filename = $this->request->data['Slide']['photo']['name'];
			if($filename){
				move_uploaded_file($this->request->data['Slide']['photo']['tmp_name'], $dir_path.$filename);
			}
		}elseif($img){
			// Delete Img
			$file = new File($dir_path.$img);
			if($file->exists()){
				$file->delete();
			}
		}
		
		// Slides
		$slides = $dir->find('.+\..+', true);
		$this->set('slides', $slides);
	}

	public function admin_index(){
		$this->Page->recursive = -1;
		$this->set('pages', $this->Page->find('all'));
		$this->set('pages_list', $this->PAGES_LIST);
	}

	public function admin_edit($id = null){
		if (!$this->Page->exists($id)) {
			throw new NotFoundException(__('页面不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('页面已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('页面保存失败，请稍候再试.'));
			}
		}else{
			$this->Page->recursive = -1;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Page->find('first', $options);
			$this->set('cate', $this->request->data['Page']['cate']);
		}
		$this->set('pages_list', $this->PAGES_LIST);
	}

	public function display($cate = null){
		$this->Page->recursive = -1;
		$options = array('conditions' => array('cate' => $cate));
		$page = $this->Page->find('first', $options);
		if($page){
			$this->set('page', $page);
		}else{
			return $this->redirect(array('action' => 'home'));
		}
		$this->set('pages_list', $this->PAGES_LIST);
	}

}




