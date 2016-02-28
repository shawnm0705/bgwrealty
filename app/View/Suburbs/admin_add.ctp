<?php 
	// Title	
	$this->assign('title', '添加新区域');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Suburb'); ?>
				<fieldset>
					<h1>添加新区域</h1>
				<?php
					echo $this->Form->input('name', array('label' => '区域名', 'type' => 'text', 'div' => array('class' => 'input text required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

