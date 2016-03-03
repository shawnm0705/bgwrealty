<head>
	<?php
	echo $this->Html->css(array('bootstrap.min.css','custom_bootstrap','style'));
	?>
</head>
<body style="background:white;">
	<div class="container">
		<div class="row">
			<center><h1>滚动图片</h1></center>
		<?php foreach($images as $image){
			echo '<div class = "col-md-3">'.$this->Html->image('Properties'.DS.$property_id.DS.$image, array('style' => 'width:100%;')).'<br/><center>'.$image.'<br/>';
			echo $this->Html->link(__('删除'), array($property_id, '?' => array('image' => $image))).'</center></div>';
			//    Add Img
		}?>
		</div>
		<div style="border:1px solid;margin-top:20px;"></div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
				<?php 
				echo $this->Form->create('Image', array('enctype' => 'multipart/form-data')); 
				echo $this->Form->input('photo', array('label' => '上传图片', 'type' => 'file'));
				echo $this->element('Submit');
				?>
			</div>
		</div>
	</div>
</body>