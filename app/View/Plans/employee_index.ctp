<?php 
	// Title	
	$this->assign('title', '计划列表');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<?php echo $this->Html->link(__('添加计划'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2><?php echo __('我的计划'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>标题</th>
						<th>类型</th>
						<th>时间</th>
						<th>内容</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($plans as $plan): ?>
						<tr>
							<td><?php echo h($plan['Plan']['name']); ?>&nbsp;</td>
							<td><?php echo h($type_list[$plan['Plan']['type']]); ?>&nbsp;</td>
							<td><?php echo h($plan['Plan']['date']); ?>&nbsp;</td>
							<td><?php echo h($plan['Plan']['content']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
								$date = new DateTime(h($plan['Plan']['date']));
								if($week_before < $date){
									echo $this->Action->index_action(array(
										'id' => h($plan['Plan']['id']), 'name' => '计划',
										'edit' => 1, 'delete' => 1));
								}
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
