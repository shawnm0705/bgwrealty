<?php 
	// Title	
	$this->assign('title', '添加新客户');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?></br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Customer'); ?>
				<fieldset><h1>添加新客户</h1>
					<h3>个人信息</h3>
				<?php
					echo $this->Form->input('name', array('label' => '姓名', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('gender', array('label' => '性别', 'type' => 'select', 'options' => array(1 => '男', 0 => '女'), 'empty' => '请选择', 'div' => array('class' => 'input required')));
					echo $this->Form->input('phone', array('label' => '手机', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'div' => array('class' => 'input required')));
					echo $this->Form->input('wechat', array('label' => '微信号', 'type' => 'text'));
					echo $this->Form->input('address', array('label' => '地址', 'type' => 'text'));
					echo $this->Form->input('Ctype', array('label' => '客户分类', 'type' => 'select', 'multiple' => true, 'options' => $cfl));
					echo $this->Form->input('Ctype2', array('label' => '客户来源', 'type' => 'select', 'multiple' => true, 'options' => $cly));

					echo '<h3>需求信息</h3>';
					echo $this->Form->input('purpose', array('label' => '购房目的', 'type' => 'select', 'options' => array('自住' => '自住', '投资' => '投资'), 'empty' => '请选择', 'div' => array('class' => 'input required')));
					?>
					<div class="input text"><label for="CustomerPriceMin">意向价格</label>$<input name="data[Customer][price_min]" type="text" id="CustomerPriceMin" class="input-100"/> 000&nbsp;-&nbsp;$<input name="data[Customer][price_max]" type="text" id="CustomerPriceMax" class="input-100"/> 000</div>
				<?php
					echo $this->Form->input('Suburb', array('label' => '意向区域', 'type' => 'select', 'multiple' => true));
					echo $this->Form->input('Ptype', array('label' => '意向户型', 'type' => 'select', 'multiple' => true));
					echo $this->Form->input('Wy', array('label' => '意向物业', 'type' => 'select', 'multiple' => true, 'options' => $wys));

					echo '<h3>管理信息</h3>';
				
					echo $this->Form->input('employee_id', array('label' => '分配', 'type' => 'select', 'options' => $employees, 'selected' => 0, 'div' => array('class' => 'input select required')));
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

