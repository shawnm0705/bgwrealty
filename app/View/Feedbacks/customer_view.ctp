<?php 
	// Title	
	$this->assign('title', '反馈信息');
	echo $this->Menu->customer();
?>

<div class="container">
	<div class="row">
		<center><h1>反馈信息</h1></center>
		<div class="col-md-8 col-md-offset-3">
			<dl class="dl-view dl-200">
				<dt>评价员工:</dt>
				<dd><?php echo h($feedback['Feedback']['rate_e']); ?>&nbsp;</dd>
				<dt>评价贷款:</dt>
				<dd><?php echo h($feedback['Feedback']['rate_dk']); ?>&nbsp;</dd>
				<dt>评价物业:</dt>
				<dd><?php echo h($feedback['Feedback']['rate_wy']); ?>&nbsp;</dd>
				<dt>备注</dt>
				<dd><?php echo h($feedback['Feedback']['content']); ?>&nbsp;</dd>
			</dl>
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改反馈信息'), array('action' => 'edit'), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>