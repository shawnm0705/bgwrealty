<?php 
	// Title	
	$this->assign('title', '查看员工信息');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>员工信息</h1></center>
		<div class="col-md-10 col-md-offset-3">
			<dl class="dl-view dl-200">
				<dt>姓名：</dt>
				<dd><?php echo h($employee['Employee']['name']); ?>&nbsp;</dd>
				<dt>性别：</dt>
				<dd><?php 
				if($employee['Employee']['gender']){
					echo '男';
				}else{
					echo '女';
				} ?>&nbsp;</dd>
				<dt>生日：</dt>
				<dd><?php echo h($employee['Employee']['dob']); ?>&nbsp;</dd>
				<dt>手机：</dt>
				<dd><?php echo h($employee['Employee']['phone']); ?>&nbsp;</dd>
				<dt>E-mail：</dt>
				<dd><?php echo h($employee['Employee']['email']); ?>&nbsp;</dd>
				<dt>微信：</dt>
				<dd><?php echo h($employee['Employee']['wechat']); ?>&nbsp;</dd>
				<dt>所属团队：</dt>
				<dd><?php 
				if($employee['Team']['name']){ 
					echo h($employee['Team']['name']);
				}else{
					echo '未分组';
				} ?>&nbsp;</dd>
				<dt>组长：</dt>
				<dd><?php 
				if($employee['Employee']['leader']){
					echo '是';
				}else{
					echo '否';
				} ?>&nbsp;</dd>
				<dt>客户：</dt>
				<dd><?php 
				foreach($customers as $customer){
					echo $customer.'<br/>';
				} 
				?>&nbsp;</dd>
				<dt>帐号：</dt>
				<dd><?php 
				if($employee['Employee']['user_id']){
					echo $employee['User']['username'];
				}else{
					echo '无帐号';
				} ?>&nbsp;</dd>
				<dt>激活：</dt>
				<dd><?php 
				if($employee['User']['active']){
					echo '已激活';
				}else{
					echo '未激活';
				} ?>&nbsp;</dd>
			</dl>	
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改员工信息'), array('action' => 'edit', $employee['Employee']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>