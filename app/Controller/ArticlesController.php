<?php
App::uses('AppController', 'Controller');
/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends AppController {

	/*public function beforeFilter() {
		$this->Auth->allow('lists');
    }*/

    public $uses = array('Article', 'Suburb', 'Property', 'Employee');

    public $TYPES_LIST = array(
    	'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态',
 		'JGXX' => '价格信息', 'LPXX' => '楼盘信息', 'ZCXXN' => '政策信息(内部)', 'SZGHN' => '市政规划(内部)', 'MZTJ' => '每周推荐',
 		'SJFX' => '数据分析', 'ZCYJ' => '政策研究', 'QYYJ' => '区域研究', 'XMYJ' => '项目研究',
 		'SJFXN' => '数据分析(内部)', 'ZCYJN' => '政策研究(内部)', 'QYYJN' => '区域研究(内部)', 'XMYJN' => '项目研究(内部)');
    public $TYPES_ARRAY = array(
    	'外部文章' => array(
    		'YNDT' => '业内动态', 'SCSJ' => '市场数据', 'ZCXX' => '政策信息', 'SZGH' => '市政规划', 'JJDT' => '经济动态'),
    	'内部通知' => array(
    		'JGXX' => '价格信息', 'LPXX' => '楼盘信息', 'ZCXXN' => '政策信息(内部)', 'SZGHN' => '市政规划(内部)', 'MZTJ' => '每周推荐'),
    	'研究报告(外部)' => array(
    		'SJFX' => '数据分析', 'ZCYJ' => '政策研究', 'QYYJ' => '区域研究', 'XMYJ' => '项目研究'),
    	'研究报告(内部)' => array(
    		'SJFXN' => '数据分析(内部)', 'ZCYJN' => '政策研究(内部)', 'QYYJN' => '区域研究(内部)', 'XMYJN' => '项目研究(内部)'));

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Article->recursive = -1;
		$this->set('articles', $this->Article->find('all'));
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$employees = $this->Employee->find('list');
		$employees[0] = '管理员';
		$this->set(compact('suburbs', 'properties', 'employees'));
		$this->set('types_list', $this->TYPES_LIST);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null){
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->Article->recursive = -1;
		$this->set('article', $this->Article->find('first', array('conditions' => 'id = '.$id)));
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$employees = $this->Employee->find('list');
		$employees[0] = '管理员';
		$this->set(compact('suburbs', 'properties', 'employees'));
		$this->set('types_list', $this->TYPES_LIST);
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->request->data['Article']['date'] = date('Y-m-d H:i:s');
			$this->request->data['Article']['employee_id'] = 0;
			$this->request->data['Article']['status'] = 'APPROVAL';
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('文章已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('文章保存失败，请稍候再试.'));
			}
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_array', $this->TYPES_ARRAY);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('文章不存在'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('文章已保存.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('文章保存失败，请稍候再试.'));
			}
		}else{
			$this->Article->recursive = -1;
			$options = array('conditions' => array('id' => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
		$suburbs = $this->Suburb->find('list');
		$suburbs[0] = '无相关区域';
		$properties = $this->Property->find('list');
		$properties[0] = '无相关楼盘';
		$this->set(compact('suburbs', 'properties'));
		$this->set('types_array', $this->TYPES_ARRAY);
		$this->set('type_selected', $this->request->data['Article']['type']);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('文章不存在'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('文章已删除.'));
		} else {
			$this->Session->setFlash(__('文章删除失败，请稍候再试.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
