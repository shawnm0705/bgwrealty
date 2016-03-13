<?php 
	// Title	
	$this->assign('title', '编写指导方案');
	echo $this->Menu->leader();
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回我的团队'), array('controller' => 'teams', 'action' => 'myteam'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Guidance'); ?>
				<fieldset>
					<h1>编写指导方案</h1>
				<?php
					echo '<h3>成员:&nbsp;'.$employee['Employee']['name'].'</h3>';
					echo $this->Form->hidden('employee_id', array('value' => $employee['Employee']['id']));
					echo $this->Form->input('customer_id', array('label' => '客户', 'type' => 'select', 'div' => array('class' => 'input required')));
					echo $this->Form->input('content', array('label' => '指导方案', 'type' => 'textarea', 'div' => array('class' => 'input required')));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

