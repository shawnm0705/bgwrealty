<?php 
	// Title	
	$this->assign('title', '我的信息');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<dl class="dl-view dl-200">
				<h2>个人信息</h2>
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
				<h2>业务信息</h2>
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
			</dl>	
			<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改信息'), array('action' => 'edit'), array('class' => 'btn btn-custom button-action')); ?></center>
		</div>
	</div>
</div>