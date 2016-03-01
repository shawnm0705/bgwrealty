<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class PagesController extends AppController {
	
	public function beforeFilter() {
		$this->Auth->allow();
    }
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Page','Article');

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	
	public function home(){
		if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	if($this->Auth->user('role') == 'admin'){
	        		return $this->redirect(array('admin' => true, 'controller' => 'pages', 'action' => 'home'));
	        	}else{
		            return $this->redirect($this->Auth->redirectUrl());
		        }
	        }
	        $this->Session->setFlash(__('用户名或密码错误!'));
	    }
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
		$this->set('articles', $articles);
		$this->set('types_list', array(
	    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'));
	}

	public function admin_home(){
				
	}

	public function admin_slides(){
				
	}

}




