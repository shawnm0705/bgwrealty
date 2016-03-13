<?php 
	// Title	
	$this->assign('title', '指导方案');
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
				<h2>指导方案</h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<?php
						if($role == 'leader'){
							echo '<th>组员</th>';
						}
						?>
						<th>客户</th>
						<th>指导方案</th>
						<?php
						if($role == 'leader'){
							echo '<th>操作</th>';
						}
						?>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($guidances as $guidance): ?>
						<tr><?php
							if($role == 'leader'){
								echo '<td>'.h($guidance['Employee']['name']).'&nbsp;</td>';
							}
							echo '<td>'.h($guidance['Customer']['name']).'&nbsp;</td>';
							echo '<td>'.h($guidance['Guidance']['content']).'&nbsp;</td>';
							if($role == 'leader'){
								echo '<td class="actions">';
									echo $this->Action->index_action(array(
										'id' => h($guidance['Guidance']['id']),
										'g_edit' => 1, 'employee_id' => $guidance['Employee']['id']));
								echo '</td>';
							}
							?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
