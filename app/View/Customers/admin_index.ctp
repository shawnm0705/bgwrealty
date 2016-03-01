<?php 
	// Title	
	$this->assign('title', '客户列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('所有客户'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>姓名</th>
						<th>购买目的</th>
						<th>意向区域</th>
						<th>意向价格</th>
						<th>意向户型</th>
						<th>客户分类</th>
						<th>客户来源</th>
						<th>帐号名</th>
						<th>激活状态</th>
						<th>负责业务员</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($customers as $customer): ?>
						<tr>
							<td><?php echo h($customer['Customer']['name']); ?>&nbsp;</td>
							<td><?php echo h($customer['Customer']['purpose']); ?>&nbsp;</td>
							<td><?php echo $customer['Customer']['suburbs']; ?>&nbsp;</td>
							<td><?php echo '$'.h($customer['Customer']['price_min']).',000 - $'.h($customer['Customer']['price_max']).',000'; ?>&nbsp;</td>
							<td><?php echo $customer['Customer']['ptypes']; ?>&nbsp;</td>
							<td><?php echo $customer['Customer']['cfls']; ?>&nbsp;</td>
							<td><?php echo $customer['Customer']['clys']; ?>&nbsp;</td>
							<td><?php 
							if($customer['Customer']['user_id']){
								echo $customer['User']['username'];
							}else{
								echo '无帐号';
							};?>&nbsp;</td>
							<td><?php 
							if($customer['User']['active']){
								echo '已激活';
							}else{
								echo '未激活';
							};?>&nbsp;</td>
							<td><?php echo h($customer['Employee']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($customer['Customer']['id']), 'name' => '客户',
									'view' => 1, 'edit' => 1, 'delete' => 1));
								?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
