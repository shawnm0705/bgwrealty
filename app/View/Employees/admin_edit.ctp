<?php 
	// Title	
	$this->assign('title', '修改员工信息');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?></br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Employee'); ?>
				<fieldset><h1>修改员工信息</h1>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('name', array('label' => '姓名', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('gender', array('label' => '性别', 'type' => 'select', 'options' => array(0 => '女', 1 => '男'), 'div' => array('class' => 'input required')));
					echo $this->Form->input('dob', array('label' => '生日', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('phone', array('label' => '手机', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('wechat', array('label' => '微信号', 'type' => 'text', 'div' => array('class' => 'input')));
					echo $this->Form->input('team_id', array('label' => '分组', 'type' => 'select', 'options' => $teams, 'div' => array('class' => 'input select required')));
					echo $this->Form->input('leader', array('label' => '是否为组长', 'type' => 'select', 'options' => array(0 => '否', 1 => '是'), 'div' => array('class' => 'input required')));
					echo $this->Form->hidden('o_team_id', array('value' => $team_id));
					echo $this->Form->hidden('o_leader', array('value' => $leader));
					echo $this->Form->hidden('user_id', array('value' => $user_id));
					
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


