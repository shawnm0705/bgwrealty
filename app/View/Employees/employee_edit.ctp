<?php 
	// Title	
	$this->assign('title', '修改我的信息');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Employee'); ?>
				<fieldset><h1>修改我的信息</h1>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('name', array('label' => '姓名', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('gender', array('label' => '性别', 'type' => 'select', 'options' => array(0 => '女', 1 => '男'), 'div' => array('class' => 'input required')));
					echo $this->Form->input('dob', array('label' => '生日', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('phone', array('label' => '手机', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('wechat', array('label' => '微信号', 'type' => 'text', 'div' => array('class' => 'input')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


