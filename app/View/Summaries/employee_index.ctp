<?php 
	// Title	
	$this->assign('title', '总结列表');
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
				<?php echo $this->Html->link(__('添加总结'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2><?php echo __('我的总结'); ?></h2>
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
						<?php foreach ($summaries as $summary): ?>
						<tr>
							<td><?php echo h($summary['Summary']['name']); ?>&nbsp;</td>
							<td><?php echo h($type_list[$summary['Summary']['type']]); ?>&nbsp;</td>
							<td><?php echo h($summary['Summary']['date']); ?>&nbsp;</td>
							<td><?php echo h($summary['Summary']['content']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
								$date = new DateTime(h($summary['Summary']['date']));
								if($week_before < $date){
									echo $this->Action->index_action(array(
										'id' => h($summary['Summary']['id']), 'name' => '总结',
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
