<?php 
	// Title	
	$this->assign('title', '我的信息');
	echo $this->Menu->customer();
?>

<div class="container">
	<div class="row">
		<center><h1>我的信息</h1></center>
		<div class="col-md-6 col-md-offset-3">
			<dl class="dl-view dl-200">
				<h2>个人信息</h2>
				<dt>姓名：</dt>
				<dd><?php echo h($customer['Customer']['name']); ?>&nbsp;</dd>
				<dt>性别：</dt>
				<dd><?php 
				if($customer['Customer']['gender']){
					echo '男';
				}else{
					echo '女';
				} ?>&nbsp;</dd>
				<dt>手机：</dt>
				<dd><?php echo h($customer['Customer']['phone']); ?>&nbsp;</dd>
				<dt>E-mail：</dt>
				<dd><?php echo h($customer['Customer']['email']); ?>&nbsp;</dd>
				<dt>微信：</dt>
				<dd><?php echo h($customer['Customer']['wechat']); ?>&nbsp;</dd>
				<dt>地址：</dt>
				<dd><?php echo h($customer['Customer']['address']); ?>&nbsp;</dd>

				<h2>需求信息</h2>
				<dt>购房目的：</dt>
				<dd><?php echo h($customer['Customer']['purpose']); ?>&nbsp;</dd>
				<dt>意向区域：</dt>
				<dd><?php echo $customer['Customer']['suburbs']; ?>&nbsp;</dd>
				<dt>意向户型：</dt>
				<dd><?php echo $customer['Customer']['ptypes']; ?>&nbsp;</dd>
				<dt>意向价格：</dt>
				<dd><?php echo '$'.h($customer['Customer']['price_min']).' 000 - $'.h($customer['Customer']['price_max']).' 000' ?>&nbsp;</dd>
			</dl>	
			<center style="margin-bottom:20px;">
				<?php 
				echo $this->Html->link(__('修改我的信息'), array('action' => 'edit', $customer['Customer']['id']), array('class' => 'btn btn-custom button-left')); 
				echo $this->Html->link(__('修改密码'), array('customer' => false, 'controller' => 'users', 'action' => 'changepassword'), array('class' => 'btn btn-custom button-left')); ?>
			</center>
		</div>
	</div>
</div>