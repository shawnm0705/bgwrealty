<?php 
	// Title	
	$this->assign('title', '修改楼盘信息');
	echo $this->Menu->admin();
	echo $this->element('JS_richtext');
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-150">
			<?php echo $this->Form->create('Property'); ?>
				<fieldset>
					<h1>修改楼盘信息</h1>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('name', array('label' => '楼盘名', 'type' => 'text', 'div' => array('class' => 'input text required')));
					echo $this->Form->input('address', array('label' => '地址', 'type' => 'text'));
					echo $this->Form->input('suburb_id', array('label' => '区域', 'type' => 'select', 'div' => array('class' => 'input required')));
					echo $this->Form->input('display', array('label' => '是否显示', 'type' => 'select', 'options' => array(0 => '否', 1 => '是'), 'div' => array('class' => 'input required')));
					echo $this->Form->input('Ptype', array('label' => '户型', 'type' => 'select', 'multiple' => true));
					echo $this->Form->input('detail', array('label' => false, 'type' => 'textarea', 'id' => 'richtextarea', 'before' => '<label for="richtextarea">楼盘信息</label><br/>'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


