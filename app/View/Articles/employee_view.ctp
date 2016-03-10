<?php 
	// Title	
	$this->assign('title', '查看文章');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
	$this->start('css');
	echo $this->Html->css('Article/view');
	$this->end();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?>
		<div class="col-md-10 col-md-offset-1">
			<div class="div-article-view"><center>
				<?php 
				echo '<h2>'.h($article['Article']['name']).'</h2>'; 
				echo h($article['Article']['date']); 
				echo '<div class="richtext">'.$article['Article']['content'].'</div></center>';
				echo '文章分类：'.$this->Html->link(h($types_list[$article['Article']['type']]), array('controller' => 'articles', 'action' => 'view_more', $article['Article']['type']));
				if($article['Article']['suburb_id']){
					echo '<br/>相关区域：'.h($suburbs[$article['Article']['suburb_id']]); 
				}
				if($article['Article']['property_id']){
					echo '<br/>相关楼盘：'.h($properties[$article['Article']['property_id']]); 
				}
				if($article['Article']['filename']){
					echo '<br/>相关文件：'.$this->Html->link(__(h($article['Article']['filename'])), array('employee' => false, 'controller' => 'files', 'action' => 'Article', $article['Article']['filename']), array('target' => '_blank', 'download' => $article['Article']['filename'])); 
				}
				 ?>
			</div>		
		</div>
	</div>
</div>