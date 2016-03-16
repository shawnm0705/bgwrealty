<?php 
	// Title	
	$this->assign('title', '修改反馈信息');
	echo $this->Menu->customer();
?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form label-150">
			<?php echo $this->Form->create('Feedback'); ?>
				<fieldset>
					<h1>修改反馈信息</h1>
				<?php
					if(isset($id)){
						echo $this->Form->input('id');
					}
					echo $this->Form->input('rate_e', array('label' => '评价员工', 'type' => 'select', 'options' => $rates, 'div' => array('class' => 'input required')));
					echo $this->Form->input('rate_dk', array('label' => '评价贷款', 'type' => 'select', 'options' => $rates, 'div' => array('class' => 'input required')));
					echo $this->Form->input('rate_wy', array('label' => '评价物业', 'type' => 'select', 'options' => $rates, 'div' => array('class' => 'input required')));
					echo $this->Form->input('content', array('label' => '备注', 'type' => 'textarea'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>


