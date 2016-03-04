<?php 
	// Title	
	$this->assign('title', '查看客户信息');
	echo $this->Menu->admin();
	$this->start('script');
	echo $this->Html->script('User/active');
	$this->end();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
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
				<dt>手机：</dt>
				<dd><?php echo h($customer['Customer']['phone']); ?>&nbsp;</dd>
				<dt>E-mail：</dt>
				<dd><?php echo h($customer['Customer']['email']); ?>&nbsp;</dd>
				<dt>微信：</dt>
				<dd><?php echo h($customer['Customer']['wechat']); ?>&nbsp;</dd>
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

				<h2>管理信息</h2>
				<dt>负责业务员：</dt>
				<dd><?php 
				if($customer['Employee']['name']){ 
					echo h($customer['Employee']['name']);
				}else{
					echo '未分配';
				} ?>&nbsp;</dd>
				<dt>帐号：</dt>
				<dd><?php 
				if($customer['Customer']['user_id']){
					echo $customer['User']['username'];
				}else{
					echo '无帐号';
				} ?>&nbsp;</dd>
				<dt>激活：</dt>
				<dd><div id="active">
				<?php 
				if($customer['User']['active']){
					echo '已激活';
				}else{
					echo '未激活';
					$customer['User']['active'] = 0;
				}
				if($customer['Customer']['user_id']){
					echo $this->Html->link(__('修改激活状态'), '#active', array('class' => 'btn btn-custom button-small', 'onclick' => 'active('.$customer['Customer']['user_id'].','.$customer['User']['active'].')', 'id' => 'btn-active'));
				}
				?>&nbsp;</div></dd>
			</dl>	
			<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改客户信息'), array('action' => 'edit', $customer['Customer']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
		</div>
	</div>
</div>