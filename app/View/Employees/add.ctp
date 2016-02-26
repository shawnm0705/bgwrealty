<?php 
	// Title	
	$this->assign('title', '添加方剂');
	echo $this->Menu->doctor();
	// CSS
	/*$this->start('css');
	echo $this->Html->css('consultation-add');
	$this->end();*/
	// Javascript
	$this->start('script');
	echo $this->Html->script(array('bootstrap3-typeahead.min','Fangji/add'));

	$this->end();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-150">
			<?php echo $this->Form->create('Fangji'); ?>
				<fieldset>
					<h1>添加新方剂</h1>
					<div id="div-medicines">
				<?php
					echo $this->Form->input('name', array('label' => '方剂名', 'type' => 'text', 'div' => array('class' => 'input text required')));
					echo $this->Form->input('medicine', 
						array('label' => '中药及用量', 
							'type' => 'text', 
							'data-provide' => 'typeahead', 
							'class' => 'medicine', 
							'name' => 'data[Fangji][Medicines][]', 
							'div' => array('class' => 'input text required')));
				?>
					<div id="div-add"></div>
					</div>
					<div style="margin-left:10px;margin-bottom:20px;">
						<label></label>
						<button type="button" id="btn-add" class="btn btn-default btn-sm">
          					<span class="glyphicon glyphicon-plus-sign"></span>添加
          				</button>
          			</div>
				</fieldset>
				<div id="hint" style="color:red;"></div>
			<?php echo $this->element('Submit_check'); ?>
			</div>
		</div>
	</div>
</div>

