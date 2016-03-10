<?php 
	// Title	
	$this->assign('title', '销售信息列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php 
				if($type == 'ZS'){
					echo '在售清单'; 
				}else{
					echo '成交清单'; 
				}
				?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>日期</th>
						<th>销售状态</th>
						<th>客户</th>
						<th>员工</th>
						<th>楼盘</th>
						<th>房号</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($deals as $deal): ?>
						<tr>
							<td>
								<?php
								$s_date = $status_date[$deal['Deal']['status']];
								echo h($deal['Deal'][$s_date]); 
								?>&nbsp;</td>
							<td>已<?php echo h($status_list[$deal['Deal']['status']]); ?>&nbsp;</td>
							<td><?php echo h($deal['Customer']['name']); ?>&nbsp;</td>
							<td><?php echo h($deal['Employee']['name']); ?>&nbsp;</td>
							<td><?php echo h($deal['Property']['name']); ?>&nbsp;</td>
							<td><?php echo h($deal['Deal']['c_unitno']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($deal['Deal']['id']), 'name' => '销售信息',
									'view' => 1, 'view_text' => '销售明细', 'delete' => 1));
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
