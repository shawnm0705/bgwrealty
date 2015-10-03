<div class="container" id="login">
    <div class="row">
    	<center>
    	<h1>谐调网站用户登录</h1>
	    <div class="col-md-4"></div>    
	    <div class="col-md-5">
	     	<?php echo $this->Form->create('User'); ?>
	     	<div class="label-100">
			<?php
				echo $this->Form->input('username', array('label' => '用户名', 'type' => 'text', 'class' => 'input-name'));
				echo $this->Form->input('password', array('label' => '密码', 'type' => 'password', 'class' => 'input-name'));
			?>
			</div>
			<div class="div-left-button">
				<?php 
					echo $this->Form->end(array('label' => '登录', 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => false)); 
					//echo $this->Html->link(__('注册'), array('controller' => 'users', 'action' => 'register'), array('class' => 'btn btn-custom btn-left'));
					//echo $this->Html->link(__('忘记密码'), array('controller' => 'users', 'action' => 'findpassword'), array('class' => 'btn btn-custom btn-left'));
				?>
			</div>
	    </div>
	</center>
	</div>
</div>