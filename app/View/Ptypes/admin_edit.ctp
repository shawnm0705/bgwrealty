<?php 
	// Title	
	$this->assign('title', '修改户型信息');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Ptype'); ?>
				<fieldset>
					<h1>修改户型信息</h1>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('name', array('label' => '户型名', 'type' => 'text', 'div' => array('class' => 'input text required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


