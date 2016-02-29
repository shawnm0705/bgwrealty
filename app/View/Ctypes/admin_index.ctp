<?php 
	// Title	
	if($type == 'KHFL'){
		$this->assign('title', '客户分类列表');
	}elseif($type == 'KHLY'){
		$this->assign('title', '客户来源列表');
	}
	echo $this->Menu->admin();
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<?php  
				if($type == 'KHFL'){
					echo $this->Html->link(__('添加客户分类'), array('action' => 'add', 'KHFL'), array('class' => 'btn btn-custom button-action'));
					echo '<h2>客户分类</h2>';
				}elseif($type == 'KHLY'){
					echo $this->Html->link(__('添加客户来源'), array('action' => 'add', 'KHLY'), array('class' => 'btn btn-custom button-action'));
					echo '<h2>客户来源</h2>';
				}
				 ?>
				
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>名称</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($ctypes as $ctype): ?>
						<tr>
							<td><?php echo h($ctype['Ctype']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Action->index_action(array(
									'id' => h($ctype['Ctype']['id']), 'name' => '分类',
									'edit' => 1, 'delete' => 1));
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
