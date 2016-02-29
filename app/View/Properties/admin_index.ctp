<?php 
	// Title	
	$this->assign('title', '楼盘列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<?php echo $this->Html->link(__('添加新楼盘'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2><?php echo __('所有楼盘'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>楼盘名</th>
						<th>地址</th>
						<th>是否显示</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($properties as $property): ?>
						<tr>
							<td><?php echo h($property['Property']['name']); ?>&nbsp;</td>
							<td><?php echo h($property['Property']['address']); ?>&nbsp;</td>
							<td><?php 
							if($property['Property']['display']){
								echo '是';
							}else{
								echo '否';
							};?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($property['Property']['id']), 'name' => '楼盘',
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
