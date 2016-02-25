<?php 
	// Title	
	$this->assign('title', '方剂列表');
	echo $this->Menu->doctor();
	// CSS
	/*$this->start('css');
	echo $this->Html->css('consultation-add');
	$this->end();
	// Javascript
	$this->start('script');
	echo $this->Html->script(array('bootstrap3-typeahead.min','Fangji/add'));
	$this->end();*/
	echo $this->element('JS_datatable');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="index well">
				<h2><?php echo __('我的方剂'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>方剂名</th>
						<th>时间</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($fangjis as $fangji): ?>
						<tr>
							<td><?php echo h($fangji['Fangji']['name']); ?>&nbsp;</td>
							<td><?php echo h($fangji['Fangji']['date']); ?>&nbsp;</td>
							<td class="actions">
								<?php 
								echo $this->Html->link(__('查看'), array('action' => 'view', h($fangji['Fangji']['id'])), array('class' => 'btn btn-custom button-action')); 
								echo $this->Html->link(__('修改'), array('action' => 'edit', h($fangji['Fangji']['id'])), array('class' => 'btn btn-custom button-action')); 
								echo $this->Form->postLink(__('删除'), array('action' => 'delete', $fangji['Fangji']['id']), array('class' => 'btn btn-custom button-action'), __('确定要删除该方剂?'));?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
