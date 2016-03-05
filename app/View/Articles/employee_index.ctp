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
<?php
	foreach($types_array as $name => $types){
		echo '<div class="row"><center><h1>'.$name.'</h1></center><br/>';
		foreach($types as $type_id => $type_name){
			echo '<div class="col-md-3">
			    <div class="panel panel-info">
				   <div class="panel-heading">
				      <h2 class="panel-title">'.$type_name.'</h2>
				   </div>
				   <div class="panel-body"><ul>';
				   	if(isset($articles[$type_id])){
					  	$n = 0;
					    foreach($articles[$type_id] as $article){
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
					}
				echo '&nbsp;</ul></div>
				</div>
			</div>';
		}
		echo '</div>';
	}
?>
</div>