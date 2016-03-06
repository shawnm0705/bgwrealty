<?php 
	// Title	
	$this->assign('title', '联系记录列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('我的联系记录'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>时间</th>
						<th>客户</th>
						<th>员工</th>
						<th>内容</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($contacts as $contact): ?>
						<tr>
							<td><?php echo h($contact['Contact']['time']); ?>&nbsp;</td>
							<td><?php echo h($contact['Customer']['name']); ?>&nbsp;</td>
							<td><?php echo h($contact['Employee']['name']); ?>&nbsp;</td>
							<td><?php echo h($contact['Contact']['content']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($contact['Contact']['id']), 'name' => '联系记录',
									'delete' => 1));
								?>&nbsp;
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
