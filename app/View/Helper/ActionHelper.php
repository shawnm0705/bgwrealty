<?php

App::uses('AppHelper', 'View/Helper');

class ActionHelper extends AppHelper {
	public $helpers = array('Form','Html');

	public function index_action($options = array()){	
		$id = $options['id'];
		
		echo '<div class="btn-group">
			<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
		    	操作<span class="caret"></span></a><ul class="dropdown-menu">';
		if(isset($options['view'])){
			if(isset($options['view_text'])){
				echo '<li>'.$this->Html->link(__($options['view_text']), array('action' => 'view', h($id))).'</li>'; 
			}else{
				echo '<li>'.$this->Html->link(__('查看'), array('action' => 'view', h($id))).'</li>'; 
			}
		}
		if(isset($options['next']) && $options['next']){
			if(isset($options['next_text'])){
				echo '<li>'.$this->Html->link(__($options['next_text']), array('action' => 'add', 
					h($options['status']), '?' => array('deal_id' => $options['deal_id']))).'</li>'; 
			}else{
				echo '<li>'.$this->Html->link(__('进行下一步'), array('action' => 'add', 
					h($options['status']), '?' => array('deal_id' => $options['deal_id']))).'</li>'; 
			}
		}
		if(isset($options['view_people'])){
			if($options['role'] == 'customer'){
				$people = 'customers';
			}elseif($options['role'] == 'employee' || $options['role'] == 'leader'){
				$people = 'employees';
			}
			if($options['role'] != 'admin'){
				if(isset($options['view_text'])){
					echo '<li>'.$this->Html->link(__($options['view_text']), array('controller' => $people, 'action' => 'view', h($options['people_id']))).'</li>'; 
				}else{
					echo '<li>'.$this->Html->link(__('查看人员信息'), array('controller' => $people, 'action' => 'view', h($options['people_id']))).'</li>'; 
				}
			}
		}
		if(isset($options['edit']) && $options['edit']){
			if(isset($options['edit_text'])){
				echo '<li>'.$this->Html->link(__($options['edit_text']), array('action' => 'view', h($id))).'</li>'; 
			}else{
				echo '<li>'.$this->Html->link(__('修改'), array('action' => 'edit', h($id))).'</li>'; 
			}
		}
		if(isset($options['delete']) && $options['delete']){
			if(isset($options['delete_text'])){
				echo '<li>'.$this->Html->link(__($options['delete_text']), array('action' => 'view', h($id))).'</li>'; 
			}else{
				echo '<li>'.$this->Form->postLink(__('删除'), array('action' => 'delete', $id), null,
					 __('确定要删除该'.$options['name'].'?')).'</li>';
			}
		}
		// Leader/Team/myteam
		if(isset($options['teammate']) && $options['teammate']){
			if(isset($options['teammate_text'])){
				echo '<li>'.$this->Html->link(__($options['teammate_text']), array('action' => 'teammate', 
					$id, '?' => array('team_id' => $options['team_id']))).'</li>'; 
			}else{
				echo '<li>'.$this->Html->link(__('成员信息'), array('action' => 'teammate', 
					$id, '?' => array('team_id' => $options['team_id']))).'</li>'; 
			}
		}
		if(isset($options['contact']) && $options['contact']){
			echo '<li>'.$this->Html->link(__('客户联系记录'), array('controller' => 'contacts', 'action' => 'index', 
					$id, '?' => array('team_id' => $options['team_id']))).'</li>'; 
		}
		// Leader/Contact/index
		if(isset($options['teamview']) && $options['teamview']){
			echo '<li>'.$this->Html->link(__('详细信息'), array('action' => 'view', 
					$id, '?' => array('employee_id' => $options['employee_id']))).'</li>'; 
		}
	    echo '</ul></div>';
		
	}
/*
echo $this->Html->link(__('查看'), array('action' => 'view', h($team['Team']['id'])), array('class' => 'btn btn-custom button-action')); 
echo $this->Html->link(__('修改'), array('action' => 'edit', h($team['Team']['id'])), array('class' => 'btn btn-custom button-action')); 
echo $this->Form->postLink(__('删除'), array('action' => 'delete', $team['Team']['id']), array('class' => 'btn btn-custom button-action'), __('确定要删除该团队?'));
*/
}
