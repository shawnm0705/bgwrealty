<?php 
	// Title	
	$this->assign('title', '添加新律师/律师行');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-200">
			<?php echo $this->Form->create('Lawyer'); ?>
				<fieldset>
					<h1>添加新律师/律师行</h1>
				<?php
					echo $this->Form->input('name', array('label' => '律师/律师行名', 'type' => 'text', 'div' => array('class' => 'input text required')));
					echo $this->Form->input('phone', array('label' => '电话', 'type' => 'text', 'div' => array('class' => 'input text required')));
					echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'div' => array('class' => 'input text required')));
					echo $this->Form->input('address', array('label' => '地址', 'type' => 'text'));
					echo $this->Form->input('detail', array('label' => '备注', 'type' => 'textarea'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

