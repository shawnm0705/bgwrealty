<?php 
	// Title	
	$this->assign('title', '查看律师/律师行');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>查看律师/律师行</h1></center>
		<div class="col-md-8 col-md-offset-3">
			<dl class="dl-view dl-250">
				<dt>律师/律师行名称：</dt>
				<dd><?php echo h($lawyer['Lawyer']['name']); ?>&nbsp;</dd>
				<dt>电话：</dt>
				<dd><?php echo h($lawyer['Lawyer']['phone']); ?>&nbsp;</dd>
				<dt>E-mail：</dt>
				<dd><?php echo h($lawyer['Lawyer']['email']); ?>&nbsp;</dd>
				<dt>地址：</dt>
				<dd><?php echo h($lawyer['Lawyer']['address']); ?>&nbsp;</dd>
				<dt>备注：</dt>
				<dd><?php echo h($lawyer['Lawyer']['detail']); ?>&nbsp;</dd>
			</dl>	
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改律师/律师行信息'), array('action' => 'edit', $lawyer['Lawyer']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>