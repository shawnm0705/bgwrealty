<?php 
	// Title	
	$this->assign('title', '客户反馈列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('所有客户反馈'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>客户</th>
						<th>评价员工</th>
						<th>评价贷款</th>
						<th>评价物业</th>
						<th>备注</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($feedbacks as $feedback): ?>
						<tr>
							<td><?php echo h($feedback['Customer']['name']); ?>&nbsp;</td>
							<td><?php echo h($feedback['Feedback']['rate_e']); ?>&nbsp;</td>
							<td><?php echo h($feedback['Feedback']['rate_dk']); ?>&nbsp;</td>
							<td><?php echo h($feedback['Feedback']['rate_wy']); ?>&nbsp;</td>
							<td><?php echo h($feedback['Feedback']['content']); ?>&nbsp;</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
