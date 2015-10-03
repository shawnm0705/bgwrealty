<?php 
  $this->start('script');
  echo $this->Html->script('check');
  $this->end();
?>

<div class="container" id="register">
    <div class="row">
    	<h2>用户注册</h2>
	    <div class="col-md-4"></div>    
	    <div class="col-md-5">
	     	<?php echo $this->Form->create('User'); ?>
	     	<div class="label-150">
			<?php
				echo $this->Form->input('username', array('label' => '用户名', 'type' => 'text', 'class' => 'input-name', 'onblur' => 'username_check(0)', 'div' => array('class' => 'input text required has-hint')));
					echo '<div class="div-hint" id="hint"></div>';
				echo $this->Form->input('password1', array('label' => '密码', 'type' => 'password', 'class' => 'input-name', 'div' => array('class' => 'input password required')));
				echo $this->Form->input('password2', array('label' => '重复密码', 'type' => 'password', 'class' => 'input-name', 'div' => array('class' => 'input password required')));
			?>
			</div>
			<div class="div-left-button">
				<?php 
					echo $this->Form->end(array('label' => '确定', 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => false)); 
					echo $this->Html->link(__('已有帐号'), array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-custom btn-left'));
					//echo $this->Html->link(__('忘记密码'), array('controller' => 'users', 'action' => 'findpassword'), array('class' => 'btn btn-custom btn-left'));
				?>
			</div>
	    </div>
	</div>
</div>