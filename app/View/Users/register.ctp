<?php 
	// Title	
	$this->assign('title', '新用户注册');
	echo $this->Menu->homepage();
?>

<div class="container">
    <div class="row">
    	<h2>新用户注册</h2>   
	    <div class="col-md-6 col-md-offset-3">
	     	<?php echo $this->Form->create('Customer'); ?>
	     	<div class="label-150">
			<?php
				echo '<h3>个人信息</h3>';
				echo $this->Form->input('name', array('label' => '姓名', 'type' => 'text', 'div' => array('class' => 'input required')));
				echo $this->Form->input('gender', array('label' => '性别', 'type' => 'select', 'options' => array(1 => '男', 0 => '女'), 'empty' => '请选择', 'div' => array('class' => 'input required')));
				echo $this->Form->input('phone', array('label' => '手机', 'type' => 'text', 'div' => array('class' => 'input required')));
				echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'div' => array('class' => 'input required'), 'between' => '<div class="notes">E-mail即为用户名</div>'));
				echo $this->Form->input('wechat', array('label' => '微信号', 'type' => 'text'));
				echo $this->Form->input('address', array('label' => '地址', 'type' => 'text'));

				echo '<h3>需求信息</h3>';
				echo $this->Form->input('purpose', array('label' => '购房目的', 'type' => 'select', 'options' => array('自住' => '自住', '投资' => '投资'), 'empty' => '请选择', 'div' => array('class' => 'input required')));
			?>
				<div class="input text"><label for="CustomerPriceMin">意向价格</label><div class="notes">价格只填纯数字</div>$<input name="data[Customer][price_min]" type="text" id="CustomerPriceMin" class="input-100"/> 000&nbsp;-&nbsp;$<input name="data[Customer][price_max]" type="text" id="CustomerPriceMax" class="input-100"/> 000</div>
				
			<?php
				echo $this->Form->input('Suburb', array('label' => '意向区域', 'type' => 'select', 'multiple' => true, 'between' => '<div class="notes">按住Ctrl同时选择,可多选</div>'));
				echo $this->Form->input('Ptype', array('label' => '意向户型', 'type' => 'select', 'multiple' => true, 'between' => '<div class="notes">按住Ctrl同时选择,可多选</div>'));
			?>
			</div>
			<?php echo $this->element('Submit'); ?>
	    </div>
	</div>
</div>