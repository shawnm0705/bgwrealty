<?php 
	// Title	
	$this->assign('title', '楼盘信息');
	if(isset($role) && $role == 'customer'){
		echo $this->Menu->customer();
	}else{
		echo $this->Menu->homepage();
	}
	$this->start('css');
	echo $this->Html->css('Property/view');
	$this->end();
	echo $this->element('JS_slider');
?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
    		<?php 
			$options['suburbs'] = $suburbs;
			$options['ptypes'] = $ptypes_all;
			$options['price'] = 100;
			echo $this->Input->p_filter($options); 
			?>
		</div>
		<div class="col-md-9">
			<div class="div-view">
				<?php echo '<h2>'.h($property['Property']['name']).'</h2>'; ?>
				<div id="myCarousel" class="carousel slide">
				  <ol class="carousel-indicators">
				  	<?php
				  	for($i=0;$i<count($slides);$i++){
				  		if($i == 0){
				  			echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
				  		}else{
				  			echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
				  		}
				  	}
				  	?>
				  </ol>
				  <!-- Carousel items -->
				  <div class="carousel-inner">
				  	<?php 
				  	$i = 1;
				  	foreach($slides as $slide){
				  		if($i){
				  			echo '<div class="active item">'.$this->Html->image('Properties'.DS.$property['Property']['id'].DS.$slide).'</div>';
				  			$i = 0;
				  		}else{
							echo '<div class="item">'.$this->Html->image('Properties'.DS.$property['Property']['id'].DS.$slide).'</div>';
						}
					}?>
				  </div>
				  <!-- Carousel nav -->
				  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
				<?php 
				echo '<div class="richtext">'.$property['Property']['detail'].'</div><dl>';
				if($property['Property']['address']){
					echo '<dt>地址：</dt><dd>'.h($property['Property']['address']).'</dd>'; 
				}
				if($property['Property']['suburb_id']){
					echo '<dt>区域：</dt><dd>'.h($suburbs[$property['Property']['suburb_id']]).'</dd>'; 
				}
				if($property['Ptype']['name']){
					echo '<dt>户型：</dt><dd>'.$property['Ptype']['name'].'</dd>'; 
				}
				if($property['Property']['price_min'] && $property['Property']['price_max']){
				 	echo '<dt>价格范围：</dt><dd>$'.h($property['Property']['price_min']).',000 - $'.h($property['Property']['price_max']).',000</dd>';
				}
				echo '</dl>';
				 ?>
				
			</div>	
		</div>
	</div>
</div>