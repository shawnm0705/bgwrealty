<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo '谐调-'; ?>
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
		//echo $this->Html->css('//cdn.datatables.net/1.10.6/css/jquery.dataTables.min.css');
 		echo $this->Html->css('custom_bootstrap');
 		echo $this->Html->css('style');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo $this->Html->script('//code.jquery.com/jquery-1.11.2.min.js');
		echo $this->fetch('script_before');
	?>
</head>
<body>
		<div id="content">
			<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright &copy; 2015 谐调人生工作室 All Rights Reserved. 版权所有
		</div>
		<?php 
		echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js');
 		//echo $this->Html->script('//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js');
		
		//echo $this->Html->script('style');
		echo $this->fetch('script');
	?>
</body>
</html>
