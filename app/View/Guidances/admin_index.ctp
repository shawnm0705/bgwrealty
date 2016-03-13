<?php 
	// Title	
	$this->assign('title', '指导方案');
	echo $this->Menu->admin();
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
						<th>团队</th>
						<th>员工</th>
						<th>客户</th>
						<th>指导方案</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($guidances as $guidance): ?>
						<tr>
						<?php
							echo '<td>'.h($guidance['Team']['name']).'&nbsp;</td>';
							echo '<td>'.h($guidance['Employee']['name']).'&nbsp;</td>';
							echo '<td>'.h($guidance['Customer']['name']).'&nbsp;</td>';
							echo '<td>'.h($guidance['Guidance']['content']).'&nbsp;</td>';
						?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
