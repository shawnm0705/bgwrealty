<?php 
	// Title	
	$this->assign('title', '添加新帐号');
	echo $this->Menu->admin();
	// Javascript
  	$this->start('script');
  	echo $this->Html->script('User/check');
  	$this->end();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-150">
			<?php echo $this->Form->create('User'); ?>
				<fieldset>
				<?php
					if($role == 'customer'){
						echo '<h1>添加用户帐号</h1>';
					}elseif($role == 'employee'){
						echo '<h1>添加员工帐号</h1>';
					}else{
						echo '<h1>添加管理员帐号</h1>';
					}
					if($role == 'admin'){
						echo $this->Form->input('username', array('label' => '用户名', 'type' => 'text', 'class' => 'input-name', 'onblur' => 'username_check()', 'div' => array('class' => 'input text required has-hint')));
						echo '<div class="div-hint" id="hint"></div>';
						echo $this->Form->input('password', array('label' => '密码', 'class' => 'input-name'));
					}else{
						echo $this->Form->input('people_id', array('label' => '个人', 'type' => 'select', 'options' => $people, 'empty' => '---请选择---', 'div' => array('class' => 'input required')));
						echo $this->Form->input('username', array('label' => '邮箱', 'type' => 'text'));
					}
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

