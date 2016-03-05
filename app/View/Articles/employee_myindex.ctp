<?php 
	// Title	
	$this->assign('title', '我的文章列表');
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
				<?php echo $this->Html->link(__('添加新文章'), array('action' => 'add'), array('class' => 'btn btn-custom button-action')); ?>
				<h2><?php echo __('我的文章'); ?></h2>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>类型</th>
						<th>文章名</th>
						<th>编写时间</th>
						<th>相关区域</th>
						<th>相关楼盘</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($articles as $article): ?>
						<tr>
							<td><?php echo h($types_list[$article['Article']['type']]); ?>&nbsp;</td>
							<td><?php echo h($article['Article']['name']); ?>&nbsp;</td>
							<td><?php echo h($article['Article']['date']); ?>&nbsp;</td>
							<td><?php echo h($suburbs[$article['Article']['suburb_id']]); ?>&nbsp;</td>
							<td><?php echo h($properties[$article['Article']['property_id']]); ?>&nbsp;</td>
							<td><?php 
							if($article['Article']['status'] == 'DRAFT'){
								echo '审核中';
							}elseif($article['Article']['status'] == 'APPROVAL'){
								echo '已审核通过';
							}?>&nbsp;</td>
							<td class="actions">
								<?php 
								if($article['Article']['status'] == 'DRAFT'){
									echo $this->Action->index_action(array(
										'id' => h($article['Article']['id']), 'name' => '文章',
										'view'=> 1, 'edit' => 1, 'delete' => 1));
								}elseif($article['Article']['status'] == 'APPROVAL'){
									echo $this->Action->index_action(array(
										'id' => h($article['Article']['id']), 'name' => '文章',
										'view'=> 1));
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
