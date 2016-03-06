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
					echo $this->Input->date(array('label' => '时间', 'name' =>'data[Contact][time]', 
						'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
					echo $this->Form->input('customer_id', array('label' => '客户', 'type' => 'select', 'empty' => '---请选择---', 'div' => array('class' => 'input required')));
					echo $this->Form->input('content', array('label' => '联系内容', 'type' => 'textarea', 'div' => array('class' => 'input required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

