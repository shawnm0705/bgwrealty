<?php 
	// Title	
	$this->assign('title', '修改信息');
	echo $this->Menu->admin();
	echo $this->element('JS_richtext');
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'emessage'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-200">
			<?php echo $this->Form->create('Page'); ?>
				<fieldset>
				<?php
					echo '<h1>修改信息</h1>';
					echo '<center>注: "$USERNAME" 和 "$PASSWORD" 分别为用户名和密码, 请勿修改或删除.</center>';
					echo $this->Form->input('id');
					echo $this->Form->input('content', array('label' => false, 'type' => 'textarea', 'id' => 'richtextarea', 'before' => '<label for="richtextarea">'.$cate.'</label><br/>'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


