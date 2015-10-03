<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '<li class="active">诗歌类别列表</li>';
	$this->Menu->breadcrumb($lists);
	// Javascript
	echo $this->element('JS_datatable');
?>
<div class="container">
	<div class="row">		
		<center><h2>诗歌类别列表</h2></center>
		<div class="col-md-2">
			<?php echo $this->Html->link(__('添加诗歌类别'), array('action' => 'add'), array('class' => 'btn btn-custom')); ?>
		</div>
		<div class="col-md-10">
			<div class="well">
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>名称</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($poemcates as $poemcate): ?>
						<tr>
							<td><?php echo h($poemcate['Poemcate']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Html->link(__('修改'), array('action' => 'edit', h($poemcate['Poemcate']['id'])), array('class' => 'btn btn-custom btn-action')); 
								echo $this->Form->postLink(__('删除'), array('action' => 'delete', h($poemcate['Poemcate']['id'])), array('class' => 'btn btn-custom btn-action'), __('确定要删除该诗歌类别?'));?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
