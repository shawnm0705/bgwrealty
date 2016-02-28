<?php 
	// Title	
	$this->assign('title', '律师/律师行列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<?php echo $this->Html->link(__('添加新律师/律师行'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2><?php echo __('所有律师/律师行'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>律师/律师行名</th>
						<th>备注</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($lawyers as $lawyer): ?>
						<tr>
							<td><?php echo h($lawyer['Lawyer']['name']); ?>&nbsp;</td>
							<td><?php echo h($lawyer['Lawyer']['detail']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($lawyer['Lawyer']['id']), 'name' => '律师/律师行',
									'view'=> 1, 'edit' => 1, 'delete' => 1));
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
