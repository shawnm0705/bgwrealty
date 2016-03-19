<?php 
  	// Title	
	$this->assign('title', '修改密码');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}elseif($role == 'customer'){
		echo $this->Menu->customer();
	}else{
		echo $this->Menu->admin();
	}
?>

<div class="container" id="register">
    <div class="row">
    	<h2>修改密码</h2>
    	<div class="col-md-6 col-md-offset-3">
	     	<?php echo $this->Form->create('User'); ?>
	     	<div class="label-150">
			<?php
				echo '<h3>用户名:'.$username.'</h3>';
				echo $this->Form->input('password1', array('label' => '密码', 'type' => 'password', 'class' => 'input-name', 'div' => array('class' => 'input password required')));
				echo $this->Form->input('password2', array('label' => '重复密码', 'type' => 'password', 'class' => 'input-name', 'div' => array('class' => 'input password required')));
			?>
			</div>
			<div class="div-left-button">
				<?php 
					echo $this->element('Submit');
				?>
			</div>
	    </div>
	</div>
</div>