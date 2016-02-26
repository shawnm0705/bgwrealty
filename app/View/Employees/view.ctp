<?php 
	// Title	
	$this->assign('title', '添加病例');
	echo $this->Menu->doctor();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>我的方剂</h1></center>
		<div class="col-md-10 col-md-offset-1">
			<dl class="dl-view dl-200">
				<dt>方剂名称：</dt>
				<dd><?php echo h($fangji['Fangji']['name']); ?>&nbsp;</dd>
				<dt>修改时间：</dt>
				<dd><?php echo h($fangji['Fangji']['date']); ?>&nbsp;</dd>
				<dt>中药及用量：</dt>
				<dd><div class="row"><?php  
				foreach($medicines as $medicine){
					echo '<div class="col-md-2">'.$medicine.'</div>';
				}
				?>&nbsp;</div></dd>
			</dl>
			<center><?php echo $this->Html->link(__('修改方剂'), array('action' => 'edit', $fangji['Fangji']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
		</div>
		
	</div>
</div>