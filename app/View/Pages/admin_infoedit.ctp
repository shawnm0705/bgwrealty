<?php 
	// Title	
	$this->assign('title', '修改信息');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'info'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-150">
			<?php echo $this->Form->create('Page'); ?>
				<fieldset>
				<?php
					echo '<h1>修改信息</h1>';
					echo $this->Form->input('id');
					echo $this->Form->input('content', array('label' => $cate, 'type' => 'textarea'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


