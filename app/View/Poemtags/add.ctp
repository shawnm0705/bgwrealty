<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '
		<li>'.$this->Html->link(__('标签列表'), 
			array('controller' => 'poemtags', 'action' => 'index')).'</li>
		<li class="active">添加标签</li>';
	$this->Menu->breadcrumb($lists);
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-5">
			<div class="form">
			<?php echo $this->Form->create('Poemtag'); ?>
				<fieldset>
					<legend><h2>添加标签</h2></legend>
				<?php
					echo $this->Form->input('name', array('label' => '名称', 'type' => 'text'));
					echo $this->Form->input('poemtagcate_id', array('label' => '类别', 'type' => 'select'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>
