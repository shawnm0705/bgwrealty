<?php 
	// Title	
	$this->assign('title', '信息列表');
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2>公司信息</h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>名称</th>
						<th>值</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($pages as $page): ?>
						<tr>
							<td><?php echo h($page['Page']['cate']); ?>&nbsp;</td>
							<td><?php echo h($page['Page']['content']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Html->link(__('编辑'), array('action' => 'infoedit', $page['Page']['id']));
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
