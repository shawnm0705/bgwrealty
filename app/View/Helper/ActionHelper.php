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
		if(isset($options['edit'])){
			if(isset($options['edit_text'])){
				echo '<li>'.$this->Html->link(__($options['edit_text']), array('action' => 'view', h($id))).'</li>'; 
			}else{
				echo '<li>'.$this->Html->link(__('修改'), array('action' => 'edit', h($id))).'</li>'; 
			}
		}if(isset($options['delete'])){
			if(isset($options['delete_text'])){
				echo '<li>'.$this->Html->link(__($options['delete_text']), array('action' => 'view', h($id))).'</li>'; 
			}else{
				echo '<li>'.$this->Form->postLink(__('删除'), array('action' => 'delete', $id), null,
					 __('确定要删除该'.$options['name'].'?')).'</li>';
			}
		}
	    echo '</ul></div>';
		
	}
/*
echo $this->Html->link(__('查看'), array('action' => 'view', h($team['Team']['id'])), array('class' => 'btn btn-custom button-action')); 
echo $this->Html->link(__('修改'), array('action' => 'edit', h($team['Team']['id'])), array('class' => 'btn btn-custom button-action')); 
echo $this->Form->postLink(__('删除'), array('action' => 'delete', $team['Team']['id']), array('class' => 'btn btn-custom button-action'), __('确定要删除该团队?'));
*/
}
