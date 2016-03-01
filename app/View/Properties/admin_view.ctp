<?php 
	// Title	
	$this->assign('title', '查看楼盘');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>查看楼盘</h1></center>
		<div class="col-md-10 col-md-offset-1">
			<dl class="dl-view dl-200">
				<dt>楼盘名称：</dt>
				<dd><?php echo h($property['Property']['name']); ?>&nbsp;</dd>
				<dt>地址：</dt>
				<dd><?php echo h($property['Property']['address']); ?>&nbsp;</dd>
				<dt>户型：</dt>
				<dd><?php echo $property['Ptype']['name']; ?>&nbsp;</dd>
				<dt>是否显示：</dt>
				<dd><?php 
				if($property['Property']['display']){
					echo '是';
				}else{
					echo '否';
				}; ?>&nbsp;</dd>
				<p>楼盘信息：</p>
				<div class="richtext"><?php echo $property['Property']['detail']; ?></div>
			</dl>	
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改楼盘信息'), array('action' => 'edit', $property['Property']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>