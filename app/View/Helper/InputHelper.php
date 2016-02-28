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
}
