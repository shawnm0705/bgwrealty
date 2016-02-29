<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $this->fetch('title'); ?>
		<?php echo '-创富地产'; ?>
	</title><link type="image/x-icon" rel="icon" href="<?php echo $this->webroot;?>img/logo-small.png">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php
		//echo $this->Html->meta('icon');
		/*
		echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
		//echo $this->Html->css('//cdn.datatables.net/1.10.6/css/jquery.dataTables.min.css');
 		echo $this->Html->css('custom_bootstrap');
 		echo $this->Html->css('style');
 		*/
 		echo $this->Html->css(array('bootstrap.min.css','custom_bootstrap','style'));
		
		echo $this->fetch('meta');
		echo $this->fetch('css');

		//echo $this->Html->script('//code.jquery.com/jquery-1.11.2.min.js');
		echo $this->Html->script('jquery.min.js');
		echo $this->fetch('script_before');
	?>
</head>
<body>
		<div id="content">
			<?php echo $this->Session->flash('flash', array('element' => 'alert')); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright &copy; <?php echo date('Y');?> BGW Realty Pty Ltd (创富地产有限公司). All Rights Reserved. 
		</div>
		<?php 
		//echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js');
		echo $this->Html->script('bootstrap.min.js');
		
		//echo $this->Html->script('style');
		echo $this->fetch('script');
	?>
</body>
</html>
