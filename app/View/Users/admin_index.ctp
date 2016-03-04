<?php 
	// Title	
	$this->assign('title', '帐号列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('用户'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>用户名</th>
						<th>权限</th>
						<th>激活状态</th>
						<th>对应人员</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
							<td><?php echo $roles[h($user['User']['role'])]; ?>&nbsp;</td>
							<td><?php 
							if($user['User']['active']){
								echo '已激活';
							}else{
								echo '未激活';
							};?>&nbsp;</td>
							<td><?php 
							if($user['User']['role'] == 'customer'){
								echo $customers[h($user['User']['role_id'])];
							}elseif($user['User']['role'] == 'employee' || $user['User']['role'] == 'leader'){
								echo $employees[h($user['User']['role_id'])];
							};?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($user['User']['id']), 'name' => '帐号',
									'view_people' => 1, 'role' => h($user['User']['role']), 'people_id' => h($user['User']['role_id']),
									'delete' => 1));
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
