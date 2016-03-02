<?php 
	// Title	
	$this->assign('title', '查看文章');
	echo $this->Menu->homepage();
	$this->start('css');
	echo $this->Html->css('Article/view');
	$this->end();
?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
    		<div class="row">
    		<?php
    		foreach($articles as $type => $article_group){
    			echo '<div class="col-md-12">
				    <div class="panel panel-info">
					   <div class="panel-heading">
					      <h2 class="panel-title">'.$types_list[$type].'</h2>
					   </div>
					   <div class="panel-body"><ul>';
						  $n = 0;
					      foreach($article_group as $article_s){
					      	if($n > 5){
					      		echo '<br/>'.$this->Html->link('更多', array('controller' => 'articles', 'action' => 'view_more', $type));
					      		break;
					      	}else{
					      		echo '<li>'.$this->Html->link(__($article_s['Article']['name']), 
		        					array('controller' => 'articles', 'action' => 'view', $article_s['Article']['id']));
						      	echo '<br/>'.h($article_s['Article']['date']).'</li>';
						      	$n ++;
					      	}
					      	
					      }
					echo '</ul></div>
					</div>
				</div>';
			}?>
			</div>
		</div>
		<div class="col-md-9">
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
					echo '<br/>相关文件：'.$this->Html->link(__(h($article['Article']['filename'])), array('controller' => 'files', 'action' => 'Article', $article['Article']['filename']), array('target' => '_blank')); 
				}
				 ?>
				
			</div>	
		</div>
	</div>
</div>