<?php
	// Title	
	$this->assign('title', '首页');
	echo $this->Menu->homepage();
	$this->start('css');
	echo $this->Html->css('Article/view');
	$this->end();
?>
<div class="container">
    <div class="row">
    	<center>
    	<?php
    	echo '<h1>'.$pages_list[$page['Page']['cate']].'</h1>';
    	echo '<div class="div-article-view">'.$page['Page']['content'].'</div>';
    	?>
	    </center>
	</div>
</div>