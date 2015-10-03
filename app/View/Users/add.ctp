<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '
		<li>'.$this->Html->link(__('用户列表'), array('action' => 'index')).'</li>
		<li class="active">添加用户</li>';
	$this->Menu->breadcrumb($lists);
	// Javascript
  	$this->start('script');
  	echo $this->Html->script('check');
  	$this->end();
?>

<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="actions">
				<?php echo $this->Html->link(__('用户列表'), array('action' => 'index'), array('class' => 'btn btn-custom')); ?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="form well">
			<?php echo $this->Form->create('User'); ?>
	     	<div class="label-100">
				<fieldset>
					<legend><?php echo __('添加用户'); ?></legend>
				<?php
					echo $this->Form->input('username', array('label' => '用户名', 'type' => 'text', 'class' => 'input-name', 'onblur' => 'username_check(0)', 'div' => array('class' => 'input text required has-hint')));
					echo '<div class="div-hint" id="hint"></div>';
					echo $this->Form->input('password', array('label' => '密码', 'class' => 'input-name'));
					echo $this->Form->input('role', array('label' => '权限', 'type' => 'select', 'options' => array('customer' => '用户', 'admin' => '管理员')));
				?>
				</fieldset>
			</div>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

