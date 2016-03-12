<?php 
	// Title	
	$this->assign('title', '我的团队');
	echo $this->Menu->leader();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('我的团队'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th><?php $me['Team']['name']?></th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($employees as $employee): ?>
						<tr>
							<td><?php echo h($employee['Employee']['name']); 
							if($employee['Employee']['leader']){
								echo '(组长)';
							}
							?>&nbsp;</td>
							<td class="actions">
								<?php 
								if($employee['Employee']['id'] != $me['Employee']['id']){
									echo $this->Action->index_action(array(
										'id' => h($employee['Employee']['id']),
										'teammate' => 1, 'team_id' => $me['Team']['id'],
										'contact' => 1));
									//================= More Action
								}
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
