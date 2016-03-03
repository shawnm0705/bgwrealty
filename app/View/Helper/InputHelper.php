<?php

App::uses('AppHelper', 'View/Helper');

class InputHelper extends AppHelper {
	public $helpers = array('Form','Html');

	public function date($options = array()){	

		echo '<div class="input select required"><label>'.$options['label'].'</label>
			<select name="'.$options['name'].'[year]">
			<option value="">请选择</option>';
			for($i=date('Y')-80;$i<=date('Y');$i++){
				echo '<option value="'.$i.'">'.$i.'</option>';	
			}
		echo '</select>年
			<select name="'.$options['name'].'[month]">
			<option value="">请选择</option>';
			for($i=1;$i<=12;$i++){
				echo '<option value="'.$i.'">'.$i.'</option>';	
			}
		echo '</select>月
			<select name="'.$options['name'].'[day]">
			<option value="">请选择</option>';
			for($i=1;$i<=31;$i++){
				echo '<option value="'.$i.'">'.$i.'</option>';	
			}
		echo '</select>日
			</div>';
	}

/**
 * 	Property Filter
 *	used in Page/home 	Property/index, view
 */
	public function p_filter($options = array()){
		echo '<div class="login well">';
    		echo $this->Form->create('Property', array('controller' => 'properties', 'action' => 'index','type' => 'get')); 
	     	echo '<div class="label-100">
		     		<h1>筛选楼盘</h1>';
		     		echo $this->Form->input('suburb_id', array('label' => '区域', 'type' => 'select', 
		     			'options' => $options['suburbs'], 'empty' => '---请选择---', 'class' => 'input-name'));
					echo $this->Form->input('ptype_id', array('label' => '户型', 'type' => 'select', 
						'options' => $options['ptypes'], 'empty' => '---请选择---', 'class' => 'input-name'));
					echo $this->Form->input('price', array('label' => '价格', 'type' => 'password', 
						'class' => 'input-name', 'id' => 'price', 'data-slider-value' => $options['price'], 
						'data-slider-min' => 100, 'data-slider-max' => 2000, 'between' => '<b>$</b>', 'after' => ',000'));				
		echo '</div>
				<div class="div-left-button">';
					echo $this->Form->end(array('label' => '查找', 'class' => 'btn btn-custom', 'id' => 'submit-button', 
						'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => false)); 
		echo '</div>
	    	</div>';
	}
}
