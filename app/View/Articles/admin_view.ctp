<?php 
	// Title	
	$this->assign('title', '查看文章');
	echo $this->Menu->admin();
	$this->start('script');
	echo $this->Html->script('Article/admin_view');
	$this->end();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>查看文章</h1></center>
		<div class="col-md-10 col-md-offset-1">
			<dl class="dl-view dl-200">
				<dt>文章名称：</dt>
				<dd><?php echo h($article['Article']['name']); ?>&nbsp;</dd>
				<dt>文章类型：</dt>
				<dd><?php echo h($types_list[$article['Article']['type']]); ?>&nbsp;</dd>
				<dt>相关区域：</dt>
				<dd><?php echo h($suburbs[$article['Article']['suburb_id']]); ?>&nbsp;</dd>
				<dt>相关楼盘：</dt>
				<dd><?php echo h($properties[$article['Article']['property_id']]); ?>&nbsp;</dd>
				<dt>相关文件：</dt>
				<dd><?php echo $this->Html->link(__(h($article['Article']['filename'])), array('admin' => false, 'controller' => 'files', 'action' => 'Article', $article['Article']['filename']), array('target' => '_blank')); ?>&nbsp;</dd>
				<dt>编写时间：</dt>
				<dd><?php echo h($article['Article']['date']); ?>&nbsp;</dd>
				<dt>作者：</dt>
				<dd><?php echo h($employees[$article['Article']['employee_id']]); ?>&nbsp;</dd>
				<dt>文章状态：</dt>
				<dd><div id="status"><?php 
				if($article['Article']['status'] == 'DRAFT'){
					echo '审核中';
					echo $this->Html->link(__('审核通过'), '#status', array('class' => 'btn btn-custom button-small', 'onclick' => 'change_s('.$article['Article']['id'].',1)', 'id' => 'btn-status'));
				}elseif($article['Article']['status'] == 'APPROVAL'){
					echo '已审核通过';
					echo $this->Html->link(__('改为审核中'), '#status', array('class' => 'btn btn-custom button-small', 'onclick' => 'change_s('.$article['Article']['id'].',0)', 'id' => 'btn-status'));
				} ?>&nbsp;</div></dd>
				<p>内容：</p>
				<div class="richtext"><?php echo $article['Article']['content']; ?></div>
			</dl>	
		</div>
		<center style="margin-bottom:20px;"><?php echo $this->Html->link(__('修改文章'), array('action' => 'edit', $article['Article']['id']), array('class' => 'btn btn-custom button-action')); ?></center>
	</div>
</div>