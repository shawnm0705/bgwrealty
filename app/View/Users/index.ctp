<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '<li class="active">用户列表</li>';
	$this->Menu->breadcrumb($lists);
	// Javascript
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="actions">
				<?php echo $this->Html->link(__('添加用户'), array('action' => 'add'), array('class' => 'btn btn-custom')); ?>
			</div>
		</div>
		<div class="col-md-10">
			<div class="index well">
				<h2><?php echo __('用户'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>用户名</th>
						<th>权限</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
							<td><?php echo $roles[h($user['User']['role'])]; ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Html->link(__('修改'), array('action' => 'edit', h($user['User']['id'])), array('class' => 'btn btn-custom')); 
								echo $this->Form->postLink(__('删除'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-custom'), __('确定要删除该用户?'));?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
