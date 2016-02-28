<?php 
	// Title	
	$this->assign('title', '添加新员工');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?></br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Employee'); ?>
				<fieldset><h1>添加新员工</h1>
				<?php
					echo $this->Form->input('name', array('label' => '姓名', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('gender', array('label' => '性别', 'type' => 'select', 'options' => array(1 => '男', 0 => '女'), 'empty' => '请选择', 'div' => array('class' => 'input required')));
					echo $this->Input->date(array('label' => '生日', 'name' =>'data[Employee][dob]'));
					echo $this->Form->input('phone', array('label' => '手机', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('wechat', array('label' => '微信号', 'type' => 'text', 'div' => array('class' => 'input')));
					echo $this->Form->input('team_id', array('label' => '分组', 'type' => 'select', 'options' => $teams, 'selected' => 0, 'div' => array('class' => 'input select required')));
					echo $this->Form->input('leader', array('label' => '是否为组长', 'type' => 'select', 'options' => array(1 => '是', 0 => '否'), 'selected' => 0, 'div' => array('class' => 'input required')));
					
					
				?>
				<div style="margin-bottom:20px;">
          			<label></label>
	          			<a class="btn btn-primary" role="button" data-toggle="collapse" href="#add-user" aria-expanded="false" aria-controls="add-user">添加帐号 (非必填)</a>
						<div class="collapse well" id="add-user">
							<?php 
							echo $this->Form->input('User.username', array('label' => '邮箱', 'type' => 'text', 'div' => array('class' => 'input required')));
							?>
						</div>
					</div>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

