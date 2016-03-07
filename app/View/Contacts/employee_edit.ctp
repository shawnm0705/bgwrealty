<?php 
	// Title	
	$this->assign('title', '添加联系记录');
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
			<?php echo $this->Form->create('Contact'); ?>
				<fieldset>
					<h1>添加联系记录</h1>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('time', array('label' => '时间', 'type' => 'text','div' => array('class' => 'input required')));
					echo $this->Form->input('customer_id', array('label' => '客户', 'type' => 'select', 'div' => array('class' => 'input required')));
					echo $this->Form->input('type', array('label' => '联系方式', 'type' => 'text'));
					echo $this->Form->input('xg', array('label' => '效果', 'type' => 'text'));
					echo $this->Form->input('khyx', array('label' => '客户意向', 'type' => 'text'));
					echo $this->Form->input('kpsj', array('label' => '看盘时间', 'type' => 'text'));
					echo $this->Form->input('property_id', array('label' => '楼盘', 'type' => 'select', 'empty' => '---请选择---'));
					echo $this->Form->input('ptype_id', array('label' => '拟推户型', 'type' => 'select', 'empty' => '---请选择---'));
					echo $this->Form->input('kpjg', array('label' => '看盘结果', 'type' => 'text'));
					echo $this->Form->input('khyj', array('label' => '客户意见', 'type' => 'text'));
					echo $this->Form->input('ctype_id', array('label' => '意向判断', 'type' => 'select', 'empty' => '---请选择---'));
					echo $this->Form->input('hxfw', array('label' => '后续服务', 'type' => 'text'));
					echo $this->Form->input('zjmsj', array('label' => '再见面时间', 'type' => 'text'));
					echo $this->Form->input('gjjh', array('label' => '跟进计划', 'type' => 'textarea'));
					echo $this->Form->input('sxzz', array('label' => '所需支持', 'type' => 'textarea'));
					echo $this->Form->input('content', array('label' => '备注', 'type' => 'textarea'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

