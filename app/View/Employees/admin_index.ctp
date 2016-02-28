<?php 
	// Title	
	$this->assign('title', '员工列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('所有员工'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>姓名</th>
						<th>性别</th>
						<th>注册时间</th>
						<th>所属团队</th>
						<th>是否为组长</th>
						<th>帐号</th>
						<th>激活状态</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($employees as $employee): ?>
						<tr>
							<td><?php echo h($employee['Employee']['name']); ?>&nbsp;</td>
							<td><?php 
							if($employee['Employee']['gender']){
								echo '男';
							}else{
								echo '女';
							};?>&nbsp;</td>
							<td><?php echo h($employee['Employee']['date']); ?>&nbsp;</td>
							<td><?php
							if($employee['Employee']['team_id']){ 
								echo h($employee['Team']['name']);
							}else{
								echo '未分组';
							} ?>&nbsp;</td>
							<td><?php 
							if($employee['Employee']['leader']){
								echo '是';
							}else{
								echo '否';
							};?>&nbsp;</td>
							<td><?php 
							if($employee['Employee']['user_id']){
								echo $employee['User']['username'];
							}else{
								echo '无帐号';
							};?>&nbsp;</td>
							<td><?php 
							if($employee['User']['active']){
								echo '已激活';
							}else{
								echo '未激活';
							};?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($employee['Employee']['id']), 'name' => '员工',
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
