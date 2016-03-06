<?php 
	// Title	
	$this->assign('title', '总结列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('所有总结'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>标题</th>
						<th>类型</th>
						<th>时间</th>
						<th>员工</th>
						<th>内容</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($summaries as $summary): ?>
						<tr>
							<td><?php echo h($summary['Summary']['name']); ?>&nbsp;</td>
							<td><?php echo h($type_list[$summary['Summary']['type']]); ?>&nbsp;</td>
							<td><?php echo h($summary['Summary']['date']); ?>&nbsp;</td>
							<td><?php echo h($summary['Employee']['name']); ?>&nbsp;</td>
							<td><?php echo h($summary['Summary']['content']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($summary['Summary']['id']), 'name' => '总结',
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
