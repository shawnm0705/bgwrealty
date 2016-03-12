<?php 
	// Title	
	$this->assign('title', '客户信息');
	echo $this->Menu->leader();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回我的团队'), array('action' => 'myteam'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<center><h1>客户信息</h1></center>
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
				<dt>注册时间：</dt>
				<dd><?php echo h($customer['Customer']['date']); ?>&nbsp;</dd>
				<dt>客户分类：</dt>
				<dd><?php echo $customer['Customer']['cfls']; ?>&nbsp;</dd>
				<dt>客户来源：</dt>
				<dd><?php echo $customer['Customer']['clys']; ?>&nbsp;</dd>

				<h2>需求信息</h2>
				<dt>购房目的：</dt>
				<dd><?php echo h($customer['Customer']['purpose']); ?>&nbsp;</dd>
				<dt>意向区域：</dt>
				<dd><?php echo $customer['Customer']['suburbs']; ?>&nbsp;</dd>
				<dt>意向户型：</dt>
				<dd><?php echo $customer['Customer']['ptypes']; ?>&nbsp;</dd>
				<dt>意向价格：</dt>
				<dd><?php echo '$'.h($customer['Customer']['price_min']).' 000 - $'.h($customer['Customer']['price_max']).' 000' ?>&nbsp;</dd>
				<dt>意向物业：</dt>
				<dd><?php echo $customer['Customer']['wys']; ?>&nbsp;</dd>
			</dl>
		</div>
	</div>
</div>