<?php
	// Title	
	$this->assign('title', '首页');
	echo $this->Menu->admin();
	echo '<div class = "container-fluid">
			<center><h1>用户首页</h1></center>
			<iframe frameborder=0  name="main"  src="'.$this->Html->url(array('admin' => false, 'controller' => 'pages', 'action' => 'home')).'" width="100%" height="500px" style="border:1px solid ;">
			</iframe>
		</div>';
?>
	