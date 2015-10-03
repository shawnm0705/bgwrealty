<?php

App::uses('AppHelper', 'View/Helper');

class FieldHelper extends AppHelper {
	public $helpers = array('Form','Html');

	public function modal($options){	
		$modal_id = $options['modal_id'];
		$header = $options['header'];
		$body_id = $options['body_id'];
		echo '<div class="modal fade" id="'.$modal_id.'" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			      	<div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				           <h1 class="modal-title" id="gridSystemModalLabel">'.$header.'</h1>
				        </div>
				        <div class="modal-body" id="'.$body_id.'">
				    	</div>
				    	<div class="modal-footer">
				    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">关闭</button>
				    	</div>
					</div>
				</div>
			</div>';
	}
	
	public function multiCheckbox($name, $label, $options = array()) {
		// options('class', 'selected')
		if (isset($options['class'])){
			$class = $options['class'];
		}else{
			$class = 'checkbox-wrapper';
		}
		if (isset($options['selected'])){
			$selected = $options['selected'];
		}else{
			$selected = null;
		}
		if(isset($options['quantity'])){
			if($options['quantity'] != 1){
				$selected_quantities = $options['quantity'];
			}
			$has_quantity = 1;
		}else{
			$has_quantity = 0;
		}

		if (isset($options['category_info'])){
			// categoried checkboxes
			$cate_list = $options['category_info']['cate_list'];
			$form_name = $options['category_info']['form_name'];
			$checkbox_id = $options['category_info']['checkbox_id'];
			if (isset($options['category_info']['selected_ids'])){
				$selected_ids = $options['category_info']['selected_ids'];
			}else{
				$selected_ids = array();
			}
			if($label){
				$result = '<div class="input select"><label>'.$label.'</label><br />';
			}else{
				$result = '';
			}
			$result .= '<div class="'.$class.'">
					<input type="hidden" name="data['.$form_name.']['.$name.']" value=""/>
						<table class="checkbox-table" border="1">';
			foreach($cate_list as $cate_name => $attrs){
				//-------------- Percentage ----------------
				$result .= '<tr><td width="10%" style="text-align:center;">'.$cate_name.'</td><td width="90%">
					<div class="row">';
				foreach($attrs as $attr_id => $attr_name){
					$result .= '<div class="col-xs-12 col-sm-2"><div class="checkbox-inline">
						<input type="checkbox" name="data['.$form_name.']['.$name.'][]" 
								value="'.$attr_id.'" id="'.$checkbox_id.$attr_id.'" ';
					if(isset($selected_ids[$attr_id])){
						$result .= 'checked="checked"';
					}
					$result .= '/>
						<label for="'.$checkbox_id.$attr_id.'">&nbsp;'.$attr_name.'</label>';
					if($has_quantity){
						$result .= '&nbsp;(用量：<input name="data[Medicine][quantity]['.$attr_id.']" 
							type="text" style="width: initial;" size="1" ';
						if(isset($selected_quantities[$attr_id])){
							$result .= 'value="'.$selected_quantities[$attr_id].'"';
						}
						$result .='/>)';
					}
					$result .= '</div></div>';
				}
				$result .= '</div></td></tr>';
			}			
			$result .='</table>
					</div>';
			if($label){
				$result .='</div>';
			}
			return $result;
		}else{
			// normal checkboxes
			if($selected){
				return $this->Form->input($name, array('label' => $label, 
					'multiple' => 'checkbox', 'selected' =>$selected, 'class' => 'checkbox-inline',  
					'between' => '<div class="'.$class.'">', 'after' =>'</div>'));
			}else{
				return $this->Form->input($name, array('label' => $label, 
					'multiple' => 'checkbox', 'class' => 'checkbox-inline',  
					'between' => '<div class="'.$class.'">', 'after' =>'</div>'));
			}
		}
	}
}