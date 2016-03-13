<?php 
	// Title	
	$this->assign('title', '修改指导方案');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Guidance'); ?>
				<fieldset>
					<h1>修改指导方案</h1>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('content', array('label' => '指导方案', 'type' => 'textarea', 'div' => array('class' => 'input required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


