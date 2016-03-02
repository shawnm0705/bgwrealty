<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class PagesController extends AppController {
	
	public function beforeFilter() {
		$this->Auth->allow('home');
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

}




