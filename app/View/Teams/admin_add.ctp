<?php 
	// Title	
	$this->assign('title', '添加新团队');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-150">
			<?php echo $this->Form->create('Team'); ?>
				<fieldset>
					<h1>添加新团队</h1>
				<?php
					echo $this->Form->input('name', array('label' => '团队名', 'type' => 'text', 'div' => array('class' => 'input text required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

