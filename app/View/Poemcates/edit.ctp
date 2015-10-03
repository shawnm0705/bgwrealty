<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '
		<li>'.$this->Html->link(__('诗歌类别列表'), 
			array('controller' => 'poemcates', 'action' => 'index')).'</li>
		<li class="active">编辑诗歌类别</li>';
	$this->Menu->breadcrumb($lists);
?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-5">
			<div class="form">
			<?php echo $this->Form->create('Poemcate'); ?>
				<fieldset>
					<legend><h2>编辑诗歌类别</h2></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('name', array('label' => '名称', 'type' => 'text'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>