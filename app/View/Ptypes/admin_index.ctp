<?php 
	// Title	
	$this->assign('title', '户型列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<?php echo $this->Html->link(__('添加新户型'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2>所有户型</h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>户型名</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($ptypes as $ptype): ?>
						<tr>
							<td><?php echo h($ptype['Ptype']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($ptype['Ptype']['id']), 'name' => '户型',
									'edit' => 1, 'delete' => 1));
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
