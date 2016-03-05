<?php 
	// Title	
	$this->assign('title', '文章列表');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
	$this->start('css');
	echo $this->Html->css('Article/view');
	$this->end();
	echo $this->element('JS_datatable');
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
					      foreach($article_group as $article){
					      	if($n > 5){
					      		echo '<br/>'.$this->Html->link('更多', array('controller' => 'articles', 'action' => 'view_more', $type));
					      		break;
					      	}else{
					      		echo '<li>'.$this->Html->link(__($article['Article']['name']), 
		        					array('controller' => 'articles', 'action' => 'view', $article['Article']['id']));
						      	echo '<br/>'.h($article['Article']['date']).'</li>';
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
			<div class="div-article-view">
				<?php echo '<h2>'.h($types_list[$this_type]).'</h2>'; ?>
				<table id="data_table" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
						<th>标题</th>
						<th>时间</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($articles[$this_type] as $article): ?>
						<tr>
							<td><?php echo $this->Html->link(__($article['Article']['name']), array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?>&nbsp;</td>
							<td><?php echo h($article['Article']['date']); ?>&nbsp;</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>