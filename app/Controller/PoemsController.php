<?php
App::uses('AppController', 'Controller');
/**
 * Poems Controller
 *
 * @property Poem $Poem
 */
class PoemsController extends AppController {

	public $uses = array('Poem','Poemtagcate','Poemtag');

	public function beforeFilter() {
		$this->Auth->allow('showbook','book','bookpage','booksmall','like','bycate','bynumber','bytag');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Poem->recursive = -1;
		$this->Poemtag->recursive = -1;
		// All Poems
		$sql = "SELECT Poem.*, Poemcate.name 
				FROM poems AS Poem
				INNER JOIN poemcates AS Poemcate
					ON Poem.poemcate_id = Poemcate.id
				ORDER BY Poem.number DESC";
		$this->set('poems', $this->Poem->query($sql));

		// Related Poemtags
		$sql = "SELECT PoemPoemtag.poem_id, Poemtag.name 
				FROM poemtags AS Poemtag
				INNER JOIN poems_poemtags AS PoemPoemtag
					ON PoemPoemtag.poemtag_id=Poemtag.id;";
		$poemtags_raw = $this->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poem_id = $poemtag_raw['PoemPoemtag']['poem_id'];
			$poemtag_name = $poemtag_raw['Poemtag']['name'];
			if(isset($poemtags[$poem_id])){
				array_push($poemtags[$poem_id], $poemtag_name);
			}else{
				$poemtags[$poem_id] =array($poemtag_name);
			}
		}
		$this->set('poemtags', $poemtags);
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$id = intval($id);
		if (!$this->Poem->exists($id)) {
			throw new NotFoundException(__('诗歌不存在'));
		}
		$this->Poem->recursive = -1;
		$this->Poemtag->recursive = -1;

		// Select Poem
		$sql = "SELECT Poem.*, Poemcate.name 
				FROM poems AS Poem
				INNER JOIN poemcates AS Poemcate
					ON Poem.poemcate_id = Poemcate.id
				WHERE Poem.id = $id LIMIT 1;";
		$this->set('poem', $this->Poem->query($sql)[0]);

		// Related Poemtags
		$sql = "SELECT Poemtag.name 
				FROM poemtags AS Poemtag
				INNER JOIN 
					(SELECT * FROM poems_poemtags WHERE poem_id = $id)
					AS PoemPoemtag
					ON PoemPoemtag.poemtag_id = Poemtag.id;";
		$poemtags_raw = $this->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			array_push($poemtags, $poemtag_raw['Poemtag']['name']);
		}
		$this->set('poemtags', $poemtags);
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

/*
	***** Poem Book *****
*/

	public function showbook($page = null){
		if($page){
			$this->set('book_page', '../book#page/'.$page);
			$this->set('book_page_small', '../booksmall/'.$page);
		}else{
			$this->set('book_page', 'book');
			$this->set('book_page_small', 'booksmall/0');
		}
		$this->set('role', $this->Auth->user('role'));
	}

	// In iframe
	public function book(){
		$this->layout = false;
		$this->Poem->recursive = -1;
		$sql = "SELECT Poem.number
				FROM poems AS Poem
				ORDER BY Poem.number DESC";
		$poems_raw = $this->Poem->query($sql);
		$poem_count = $poems_raw[0]['Poem']['number'];
		if($poem_count%2 == 0){
			$this->set('poems', $poem_count+4);
		}else{
			$this->set('poems', $poem_count+5);
		}		
		$this->set('role', $this->Auth->user('role'));
	}

	public function bookpage($id = null){
		$this->layout = false;
		$this->Poem->recursive = -1;
		$id = intval($id);

		// Select Poem
		$id = $id - 4;
		$sql = "SELECT Poem.*
				FROM poems AS Poem
				WHERE Poem.number = $id LIMIT 1;";
		$poems = $this->Poem->query($sql);
		$poem = '';
		if($poems){
			$poem = $poems[0];
		}
		$this->set('poem', $poem);
		$this->set('role', $this->Auth->user('role'));
	}

	public function booksmall($id = null){
		$this->layout = false;
		$this->Poem->recursive = -1;
		if($id){
			$id = intval($id);

			// Select Poem
			$id = $id - 4;
			$options = array(
				'conditions' => array('Poem.number' => array($id, $id + 1)),
				'order' => array('Poem.number'));
		}else{
			$options = array('order' => array('Poem.number'));
		}
		$this->set('poems', $this->Poem->find('all', $options));
		$this->set('role', $this->Auth->user('role'));
	}

	public function like($poem_id = null){
		$this->layout = false;		
		if($poem_id && $this->request->query['like_number']){
			$poem['Poem']['id'] = intval($poem_id);
			$poem['Poem']['like'] = intval($this->request->query['like_number']);
			$this->Poem->save($poem);
		}
	}

/*
	***** Poem Book Search *****
*/
	public function bycate(){
		$this->Poem->recursive = -1;
		$sql = "SELECT Poem.*
				FROM poems AS Poem
				ORDER BY Poem.number ASC;";
		$poems_raw = $this->Poem->query($sql);
		$poemcates = $this->Poem->Poemcate->find('list');
		$poems = array();
		foreach($poems_raw as $poem){
			$number = $poem['Poem']['number'];
			$title = $poem['Poem']['title'];
			$cate = $poem['Poem']['poemcate_id'];
			$poems[$cate][$number] = $title;
		}
		$this->set(compact('poems', 'poemcates'));
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

	public function bynumber(){
		$this->Poem->recursive = -1;
		$sql = "SELECT Poem.*
				FROM poems AS Poem
				ORDER BY Poem.number ASC;";
		$poems = $this->Poem->query($sql);
		$this->set('poems', $poems);
		$this->set('role', $this->Auth->user('role'));
	}

	public function bytag(){
		$this->Poemtag->recursive = -1;
		if ($this->request->query) {
			$this->Poem->recursive = -1;
			$query_poemtag_ids = $this->request->query['data']['Poemtag']['Poemtag'];
			$poems_result = array();
			$query_poemtags = array();
			if($query_poemtag_ids){
				$count = count($query_poemtag_ids);
				$options = array(
					'joins' => array(
						array('table' => 'poems_poemtags', 'alias' => 'PoemPoemtag', 
							'conditions' => 'PoemPoemtag.poem_id = Poem.id')),
					'fields' => array('Poem.*'),
					'conditions' => array('PoemPoemtag.poemtag_id' => $query_poemtag_ids),
					'group' => array("Poem.id having count(Poem.id) = $count")
					);
				$poems_result = $this->Poem->find('all', $options);
				$poemtag_list = $this->Poemtag->find('list');
				foreach($query_poemtag_ids as $poemtag_id){
					array_push($query_poemtags, $poemtag_list[$poemtag_id]);
				}
			}
			$this->set(compact('poems_result', 'query_poemtags'));

		}
		$sql = "SELECT Poemtag.*, Poemtagcate.name 
				FROM poemtags AS Poemtag
				INNER JOIN poemtagcates AS Poemtagcate
					ON Poemtag.poemtagcate_id=Poemtagcate.id;";
		$poemtags_raw = $this->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtagcate_name = $poemtag_raw['Poemtagcate']['name'];
			$poemtag_id = $poemtag_raw['Poemtag']['id'];
			$poemtag_name = $poemtag_raw['Poemtag']['name'];
			$poemtags[$poemtagcate_name][$poemtag_id] = $poemtag_name;
		}
		$this->set('poemtags', $poemtags);
		$this->set('role', $this->Auth->user('role'));
	}
	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Poem']['time'] = date('Y-m-d H:i:s');
			$this->Poem->create();
			if ($this->Poem->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌保存失败，请稍候再试.'));
			}
		}
		$sql = "SELECT Poemtag.*, Poemtagcate.name 
				FROM poemtags AS Poemtag
				INNER JOIN poemtagcates AS Poemtagcate
				ON Poemtag.poemtagcate_id=Poemtagcate.id;";
		$poemtags_raw = $this->Poem->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtagcate_name = $poemtag_raw['Poemtagcate']['name'];
			$poemtag_id = $poemtag_raw['Poemtag']['id'];
			$poemtag_name = $poemtag_raw['Poemtag']['name'];
			$poemtags[$poemtagcate_name][$poemtag_id] = $poemtag_name;
		}
		$this->set('poemtags', $poemtags);
		$this->Poemtagcate->recursive = -1;
		$this->set('poemtagcates', $this->Poemtagcate->find('list'));
		$this->set('poemcates', $this->Poem->Poemcate->find('list'));
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

	public function poemtags(){
		$this->layout = false;
		$sql = "SELECT Poemtag.*, Poemtagcate.name 
				FROM poemtags AS Poemtag
				INNER JOIN poemtagcates AS Poemtagcate
				ON Poemtag.poemtagcate_id=Poemtagcate.id;";
		$poemtags_raw = $this->Poem->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtagcate_name = $poemtag_raw['Poemtagcate']['name'];
			$poemtag_id = $poemtag_raw['Poemtag']['id'];
			$poemtag_name = $poemtag_raw['Poemtag']['name'];
			$poemtags[$poemtagcate_name][$poemtag_id] = $poemtag_name;
		}
		$this->set('poemtags', $poemtags);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$id = intval($id);
		if (!$this->Poem->exists($id)) {
			throw new NotFoundException(__('诗歌不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Poem->save($this->request->data)) {
				$this->Session->setFlash(__('诗歌已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('诗歌保存失败，请稍候再试.'));
			}
		} else {
			$this->Poem->recursive = -1;
			$sql = "SELECT * FROM poems AS Poem WHERE id = $id LIMIT 1;";
			$this->request->data = $this->Poem->query($sql)[0];
		}

		//-- Selected Poemtags
		$sql = "SELECT poems_poemtags.poemtag_id
				FROM poems AS Poem
				INNER JOIN poems_poemtags
				ON poems_poemtags.poem_id=Poem.id
				WHERE poems_poemtags.poem_id = $id;";
		$poemtags_raw = $this->Poem->query($sql);
		$selected_poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtag_id = $poemtag_raw['poems_poemtags']['poemtag_id'];
			$selected_poemtags[$poemtag_id] = 1;
		}
		$this->set('selected_poemtags', $selected_poemtags);

		//-- All Poemtags
		$sql = "SELECT Poemtag.*, Poemtagcate.name 
				FROM poemtags AS Poemtag
				INNER JOIN poemtagcates AS Poemtagcate
				ON Poemtag.poemtagcate_id=Poemtagcate.id;";
		$poemtags_raw = $this->Poem->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtagcate_name = $poemtag_raw['Poemtagcate']['name'];
			$poemtag_id = $poemtag_raw['Poemtag']['id'];
			$poemtag_name = $poemtag_raw['Poemtag']['name'];
			$poemtags[$poemtagcate_name][$poemtag_id] = $poemtag_name;
		}
		$this->set('poemtags', $poemtags);

		//-- All Poemtagcates
		$this->Poemtagcate->recursive = -1;
		$this->set('poemtagcates', $this->Poemtagcate->find('list'));
		$this->set('poemcates', $this->Poem->Poemcate->find('list'));
        //$this->set('username',$this->Auth->user('username'));
		$this->set('role', $this->Auth->user('role'));
	}

	public function poemtagsedit($id = null){
		$this->layout = false;
		$id = intval($id);

		//-- Selected Poemtags
		$sql = "SELECT poems_poemtags.poemtag_id
				FROM poems AS Poem
				INNER JOIN poems_poemtags
				ON poems_poemtags.poem_id=Poem.id
				WHERE poems_poemtags.poem_id = $id;";
		$poemtags_raw = $this->Poem->query($sql);
		$selected_poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtag_id = $poemtag_raw['poems_poemtags']['poemtag_id'];
			$selected_poemtags[$poemtag_id] = 1;
		}
		$this->set('selected_poemtags', $selected_poemtags);

		//-- All Poemtags
		$sql = "SELECT Poemtag.*, Poemtagcate.name 
				FROM poemtags AS Poemtag
				INNER JOIN poemtagcates AS Poemtagcate
				ON Poemtag.poemtagcate_id=Poemtagcate.id;";
		$poemtags_raw = $this->Poem->Poemtag->query($sql);
		$poemtags = array();
		foreach($poemtags_raw as $poemtag_raw){
			$poemtagcate_name = $poemtag_raw['Poemtagcate']['name'];
			$poemtag_id = $poemtag_raw['Poemtag']['id'];
			$poemtag_name = $poemtag_raw['Poemtag']['name'];
			$poemtags[$poemtagcate_name][$poemtag_id] = $poemtag_name;
		}
		$this->set('poemtags', $poemtags);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Poem->id = $id;
		if (!$this->Poem->exists()) {
			throw new NotFoundException(__('诗歌不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Poem->delete()) {
			$this->Session->setFlash(__('诗歌已删除.'));
		} else {
			$this->Session->setFlash(__('诗歌删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}