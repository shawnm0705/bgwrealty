<?php 
	// Title	
	$this->assign('title', '成员信息');
	echo $this->Menu->leader();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回我的团队'), array('action' => 'myteam'), array('class' => 'btn btn-custom button-action')); ?><br/>
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
				<dt>客户：</dt>
				<dd><?php 
				foreach($customers as $id => $customer){
					echo $this->Html->link(__($customer), array('action' => 'teamcustomer', $id, '?' => array('e_id' => $employee['Employee']['id']))).'<br/>';
				} 
				?>&nbsp;</dd>
			</dl>	
		</div>
	</div>
</div>




