<?php 
	// Title	
	$this->assign('title', '查看物业');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>查看物业</h1></center>
		<div class="col-md-10 col-md-offset-3">
			<dl class="dl-view dl-200">
				<dt>物业名称：</dt>
				<dd><?php echo h($wy['Wy']['name']); ?>&nbsp;</dd>
				<dt>电话：</dt>
				<dd><?php echo h($wy['Wy']['phone']); ?>&nbsp;</dd>
				<dt>E-mail：</dt>
				<dd><?php echo h($wy['Wy']['email']); ?>&nbsp;</dd>
				<dt>地址：</dt>
				<dd><?php echo h($wy['Wy']['address']); ?>&nbsp;</dd>
				<dt>备注：</dt>
				<dd><?php echo h($wy['Wy']['detail']); ?>&nbsp;</dd>
			</dl>	
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改物业信息'), array('action' => 'edit', $wy['Wy']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>