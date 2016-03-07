<?php 
	// Title	
	$this->assign('title', '查看联系记录');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>查看联系记录</h1></center>
		<div class="col-md-8 col-md-offset-3">
			<dl class="dl-view dl-250">
				<dt>联系时间：</dt>
				<dd><?php echo h($contact['Contact']['time']); ?>&nbsp;</dd>
				<dt>记录时间：</dt>
				<dd><?php echo h($contact['Contact']['date']); ?>&nbsp;</dd>
				<dt>员工：</dt>
				<dd><?php echo h($contact['Employee']['name']); ?>&nbsp;</dd>
				<dt>客户：</dt>
				<dd><?php echo h($contact['Customer']['name']); ?>&nbsp;</dd>
				<dt>联系方式：</dt>
				<dd><?php echo h($contact['Contact']['type']); ?>&nbsp;</dd>
				<dt>效果：</dt>
				<dd><?php echo h($contact['Contact']['xg']); ?>&nbsp;</dd>
				<dt>客户意向：</dt>
				<dd><?php echo h($contact['Contact']['khyx']); ?>&nbsp;</dd>
				<dt>看盘时间：</dt>
				<dd><?php echo h($contact['Contact']['kpsj']); ?>&nbsp;</dd>
				<dt>楼盘：</dt>
				<dd><?php echo h($contact['Property']['name']); ?>&nbsp;</dd>
				<dt>拟推户型：</dt>
				<dd><?php echo h($contact['Ptype']['name']); ?>&nbsp;</dd>
				<dt>看盘结果：</dt>
				<dd><?php echo h($contact['Contact']['kpjg']); ?>&nbsp;</dd>
				<dt>客户意见：</dt>
				<dd><?php echo h($contact['Contact']['khyj']); ?>&nbsp;</dd>
				<dt>意向判断：</dt>
				<dd><?php echo h($contact['Ctype']['name']); ?>&nbsp;</dd>
				<dt>后续服务：</dt>
				<dd><?php echo h($contact['Contact']['hxfw']); ?>&nbsp;</dd>
				<dt>再见面时间：</dt>
				<dd><?php echo h($contact['Contact']['zjmsj']); ?>&nbsp;</dd>
				<dt>跟进计划：</dt>
				<dd><?php echo h($contact['Contact']['gjjh']); ?>&nbsp;</dd>
				<dt>所需支持：</dt>
				<dd><?php echo h($contact['Contact']['sxzz']); ?>&nbsp;</dd>
				<dt>备注：</dt>
				<dd><?php echo h($contact['Contact']['content']); ?>&nbsp;</dd>
			</dl>	
		</div>
	</div>
</div>