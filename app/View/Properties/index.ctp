<?php 
	// Title	
	$this->assign('title', '楼盘汇总');
	echo $this->Menu->homepage();
	$this->start('css');
	echo $this->Html->css(array('Property/index','slider'));
	$this->end();
	$this->start('script');
	echo $this->Html->script(array('modernizr', 'bootstrap-slider', 'Property/index'));
	$this->end();

?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
    		<div class="login well">
	    		<?php echo $this->Form->create('Property', array('action' => 'index','type' => 'get')); ?>
		     	<div class="label-100">
		     		<h1>筛选楼盘</h1>
				<?php
					echo $this->Form->input('suburb_id', array('label' => '区域', 'type' => 'select', 'options' => $suburbs, 'empty' => '---请选择---', 'class' => 'input-name'));
					echo $this->Form->input('price', array('label' => '价格', 'type' => 'password', 'class' => 'input-name', 'id' => 'price', 'data-slider-value' => $price, 'data-slider-min' => 100, 'data-slider-max' => 2000, 'between' => '<b>$</b>', 'after' => ',000'));
				?>
				</div>
				<div class="div-left-button">
					<?php 
						echo $this->Form->end(array('label' => '查找', 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => false)); 
					?>
				</div>
	    	</div>
		</div>
		<div class="col-md-9">
			<div class="div-index">
				<h1>楼盘汇总</h1>
				<?php 
				foreach($properties as $property){
					$id = $property['Property']['id'];
	    			echo '<div class="row">
					    <div class="panel panel-default">
						   <div class="panel-heading">
						      <h2 class="panel-title">'.$this->Html->link(h($property['Property']['name']), array('action' => 'view', $id)).'</h2>
						   </div>
						   <div class="panel-body">';
						   // Slides
						echo '<div class="col-md-6">';
						if(isset($slides[$id])){
							echo '<div id="Carousel'.$id.'" class="carousel slide">
									  <ol class="carousel-indicators">';
									  	for($i=0;$i<count($slides[$id]);$i++){
									  		if($i == 0){
									  			echo '<li data-target="#Carousel'.$id.'" data-slide-to="0" class="active"></li>';
									  		}else{
									  			echo '<li data-target="#Carousel'.$id.'" data-slide-to="'.$i.'"></li>';
									  		}
									  	}
								echo '</ol>
									  <!-- Carousel items -->
									  <div class="carousel-inner">';
									  	$i = 1;
									  	foreach($slides[$id] as $slide){
									  		if($i){
									  			echo '<div class="active item">'.$this->Html->image('Properties'.DS.$id.DS.$slide).'</div>';
									  			$i = 0;
									  		}else{
												echo '<div class="item">'.$this->Html->image('Properties'.DS.$id.DS.$slide).'</div>';
											}
										}
								echo '</div>
									  <!-- Carousel nav -->
									  <a class="carousel-control left" href="#Carousel'.$id.'" data-slide="prev">&lsaquo;</a>
									  <a class="carousel-control right" href="#Carousel'.$id.'" data-slide="next">&rsaquo;</a>
									</div>';
						}		
							echo '</div>';
						
								// Content
							echo '<div class="col-md-6">
									<dl>
										<dt>区域：</dt>
										<dd>'.h($suburbs[$property['Property']['suburb_id']]).'&nbsp;</dd>
										<dt>地址：</dt>
										<dd>'.h($property['Property']['address']).'&nbsp;</dd>
										<dt>价格范围：</dt>
										<dd>$'.h($property['Property']['price_min']).' 000 - $'.h($property['Property']['price_max']).' 000&nbsp;</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>';
				}?>
				
			</div>	
		</div>
	</div>
</div>