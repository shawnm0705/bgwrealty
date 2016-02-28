<?php 
	// Title	
	$this->assign('title', '区域列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<?php echo $this->Html->link(__('添加新区域'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2><?php echo __('所有区域'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>区域名</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($suburbs as $suburb): ?>
						<tr>
							<td><?php echo h($suburb['Suburb']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($suburb['Suburb']['id']), 'name' => '区域',
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
