<?php 
	// Title	
	$this->assign('title', '团队列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('所有团队'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>团队名</th>
						<th>人数</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($teams as $team): ?>
						<tr>
							<td><?php echo h($team['Team']['name']); ?>&nbsp;</td>
							<td><?php echo h($team['Team']['number']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($team['Team']['id']), 'name' => '团队',
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
