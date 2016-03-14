<?php 
	// Title	
	$this->assign('title', '数据备份');
	echo $this->Menu->admin();
?>
<div class="container">
	<h3>数据备份文件</h3><br/>
	<center style="margin:30px;font-size:20px;"><?php echo $this->Html->link($filename, '/files/'.$filename, array('target' => '_blank', 'download' => $filename));?></center>
</div>