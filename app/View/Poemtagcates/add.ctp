<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '
		<li>'.$this->Html->link(__('标签类别列表'), 
			array('controller' => 'poemtagcates', 'action' => 'index')).'</li>
		<li class="active">添加标签类别</li>';
	$this->Menu->breadcrumb($lists);
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-5">
			<div class="form">
			<?php echo $this->Form->create('Poemtagcate'); ?>
				<fieldset>
					<legend><h2>添加标签类别</h2></legend>
				<?php
					echo $this->Form->input('name', array('label' => '名称', 'type' => 'text'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>
