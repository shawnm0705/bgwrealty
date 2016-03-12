<?php
	// Title	
	$this->assign('title', '首页');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
?>
	<center><h1>欢迎来到 BGW Realty 创富地产 管理系统</h1></center>