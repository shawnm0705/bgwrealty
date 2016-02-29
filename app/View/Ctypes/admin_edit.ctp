<?php 
	// Title	
	if($type == 'KHFL'){
		$this->assign('title', '添加客户分类');
	}elseif($type == 'KHLY'){
		$this->assign('title', '添加客户来源');
	}
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Ctype'); ?>
				<fieldset>
				<?php	
					if($type == 'KHFL'){
						echo '<h1>添加客户分类</h1>';
					}elseif($type == 'KHLY'){
						echo '<h1>添加客户来源</h1>';
					}
						
					echo $this->Form->hidden('type', array('value' => $type));
					echo $this->Form->input('id');
					echo $this->Form->input('name', array('label' => '名称', 'type' => 'text', 'div' => array('class' => 'input text required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>



