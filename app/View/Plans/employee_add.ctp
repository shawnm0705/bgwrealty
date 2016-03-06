<?php 
	// Title	
	$this->assign('title', '添加计划');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Plan'); ?>
				<fieldset>
					<h1>添加计划</h1>
				<?php
					echo $this->Form->input('name', array('label' => '标题', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('hidden', array('label' => false, 'type' => 'text', 'class' => 'input-hidden'));
					echo $this->Form->input('type', array('label' => '计划类型', 'type' => 'select', 'options' => $type_list, 'div' => array('class' => 'input required')));
					echo $this->Form->input('content', array('label' => '内容', 'type' => 'textarea', 'div' => array('class' => 'input required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

