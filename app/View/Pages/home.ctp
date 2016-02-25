<?php
	// Title	
	$this->assign('title', '首页');
	echo $this->Menu->homepage();
	echo '<center>';
	echo $this->Html->link(__('管理员'), array('admin' => true, 'controller' => 'pages', 'action' => 'home'));
	echo '</center>';
?>