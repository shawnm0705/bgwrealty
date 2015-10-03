<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '<li class="active">标签列表</li>';
	$this->Menu->breadcrumb($lists);
	// Javascript
	echo $this->element('JS_datatable');
?>
<div class="container">
	<div class="row">		
		<center><h2>标签列表</h2></center>
		<div class="col-md-2">
			<?php echo $this->Html->link(__('添加标签'), array('action' => 'add'), array('class' => 'btn btn-custom')); ?>
		</div>
		<div class="col-md-10">
			<div class="well">
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>名称</th>
						<th>标签类别</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($poemtags as $poemtag): ?>
						<tr>
							<td><?php echo h($poemtag['Poemtag']['name']); ?>&nbsp;</td>
							<td><?php echo h($poemtag['Poemtagcate']['name']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Html->link(__('修改'), array('action' => 'edit', h($poemtag['Poemtag']['id'])), array('class' => 'btn btn-custom btn-action')); 
								echo $this->Form->postLink(__('删除'), array('action' => 'delete', h($poemtag['Poemtag']['id'])), array('class' => 'btn btn-custom btn-action'), __('确定要删除该标签?'));?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
