<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '<li class="active">诗歌列表</li>';
	$this->Menu->breadcrumb($lists);
	// Javascript
	echo $this->element('JS_datatable');
?>
<div class="container">
	<div class="row">		
		<center><h2>诗歌列表</h2></center>
		<div class="col-md-2">
			<?php echo $this->Html->link(__('添加诗歌'), array('action' => 'add'), array('class' => 'btn btn-custom')); ?>
		</div>
		<div class="col-md-10">
			<div class="well">
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>编号</th>
						<th>标题</th>
						<th>类别</th>
						<th>标签</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($poems as $poem): ?>
						<tr>
							<td><?php echo h($poem['Poem']['number']); ?>&nbsp;</td>
							<td><?php echo h($poem['Poem']['title']); ?>&nbsp;</td>
							<td><?php echo h($poem['Poemcate']['name']); ?>&nbsp;</td>
							<td><?php 
								$poem_id = $poem['Poem']['id'];
								if(isset($poemtags[$poem_id])){
									foreach($poemtags[$poem_id] as $name){
										echo h($name).'，&nbsp;';
									} 
								}
								?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Html->link(__('查看'), array('action' => 'view', h($poem['Poem']['id'])), array('class' => 'btn btn-custom btn-action')); 
								echo $this->Html->link(__('修改'), array('action' => 'edit', h($poem['Poem']['id'])), array('class' => 'btn btn-custom btn-action')); 
								echo $this->Form->postLink(__('删除'), array('action' => 'delete', h($poem['Poem']['id'])), array('class' => 'btn btn-custom btn-action'), __('确定要删除该诗歌?'));?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
