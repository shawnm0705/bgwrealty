<?php 
	// Title	
	$this->assign('title', '联系记录列表');
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
				<?php 
				if($role == 'employee'){
					echo $this->Html->link(__('添加联系记录'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); 
				}else{
					echo $this->Html->link(__('返回我的团队'), array('controller' => 'teams', 'action' => 'myteam'), array('class' => 'btn btn-custom button-action')); 
				}
				?>
				<h2><?php 
				if(isset($employee)){
					echo $employee['Employee']['name'].'的联系记录';
				}else{
					echo __('我的联系记录'); 
				}
				?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>时间</th>
						<th>客户</th>
						<th>备注</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($contacts as $contact): ?>
						<tr>
							<td><?php echo h($contact['Contact']['time']); ?>&nbsp;</td>
							<td><?php echo h($contact['Customer']['name']); ?>&nbsp;</td>
							<td><?php echo h($contact['Contact']['content']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								$week_before = new DateTime(date('Y-m-d H:i:s', strtotime('-7 day')));
								$date = new DateTime(h($contact['Contact']['date']));
								if($week_before < $date){
									if($role == 'leader'){
										echo $this->Action->index_action(array(
											'id' => h($contact['Contact']['id']), 'name' => '联系记录',
											'teamview' => 1, 'employee_id' => $employee['Employee']['id']));
									}else{
										echo $this->Action->index_action(array(
											'id' => h($contact['Contact']['id']), 'name' => '联系记录',
											'view' => 1, 'edit' => 1, 'delete' => 1));
									}
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
