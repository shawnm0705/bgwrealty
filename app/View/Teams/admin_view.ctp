<?php 
	// Title	
	$this->assign('title', '查看团队');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>查看团队</h1></center>
		<div class="col-md-10 col-md-offset-3">
			<dl class="dl-view dl-200">
				<dt>团队名称：</dt>
				<dd><?php echo h($team['Team']['name']); ?>&nbsp;</dd>
				<dt>人数：</dt>
				<dd><?php echo h($team['Team']['number']); ?>&nbsp;</dd>
				<dt>成员：</dt>
				<dd><?php  
				foreach($employees as $employee){
					echo $employee.'<br/>';
				}
				?>&nbsp;</dd>
			</dl>	
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改团队信息'), array('action' => 'edit', $team['Team']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>