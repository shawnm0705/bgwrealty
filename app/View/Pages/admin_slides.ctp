<?php 
	// Title	
	$this->assign('title', '首页图片');
	echo $this->Menu->admin();
?>
<div class="container">
	<div class="row">
	<?php foreach($slides as $slide){
		echo '<div class = "col-md-3">'.$this->Html->image('slides/'.$slide, array('style' => 'width:100%;')).'<br/><center>'.$slide.'<br/>';
		echo $this->Html->link(__('删除'), array('controller' => 'pages', 'action' => 'slides', $slide)).'</center></div>';
		//    Add Img
	}?>
	</div>
	<div style="border:1px solid;margin-top:20px;"></div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3" style="margin-top:50px;">
			<?php 
			echo $this->Form->create('Slide', array('enctype' => 'multipart/form-data')); 
			echo $this->Form->input('photo', array('label' => '上传图片', 'type' => 'file'));
			echo $this->element('Submit');
			?>
		</div>
	</div>
</div>