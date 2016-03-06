<?php
	// Title	
	$this->assign('title', '首页');
	echo $this->Menu->homepage();
	$this->start('css');
	echo $this->Html->css(array('Page/home'));
	$this->end();
	echo $this->element('JS_slider');
?>
<div class="container">
    <div class="row">
    	<div class="col-md-12">
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
			  			echo '<div class="active item">'.$this->Html->image('Slides/'.$slide).'</div>';
			  			$i = 0;
			  		}else{
						echo '<div class="item">'.$this->Html->image('Slides/'.$slide).'</div>';
					}
				}?>
			  </div>
			  <!-- Carousel nav -->
			  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
	</div>

    <div class="row">
    	<div class="col-md-3">
    		<div class="login well">
	    		<?php 
	    		if(isset($role) && $role == 'employee'){
	    			echo $this->Html->link(__('转到内部管理系统'), array('employee' => true, 'controller' => 'pages', 'action' => 'home'), array('class' => 'btn btn-custom'));
	    		}else{
		    		echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login')); 
			     	echo '<div class="label-100">
			     		<h3>用户登录</h3>';
						echo $this->Form->input('username', array('label' => '用户名', 'type' => 'text', 'class' => 'input-name'));
						echo $this->Form->input('password', array('label' => '密码', 'type' => 'password', 'class' => 'input-name'));
					echo '</div>
					<div class="div-left-button">';
						echo $this->Form->end(array('label' => '登录', 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => false)); 
						//echo $this->Html->link(__('注册'), array('controller' => 'users', 'action' => 'register'), array('class' => 'btn btn-custom btn-left'));
						//echo $this->Html->link(__('忘记密码'), array('controller' => 'users', 'action' => 'findpassword'), array('class' => 'btn btn-custom btn-left'));
					echo '</div>';
				}
				?>
	    	</div>
	    </div>
    	<div class="col-md-6">
    		<div class="row">
    		<?php
    		foreach($articles as $type => $article_group){
    			echo '<div class="col-md-12">
				    <div class="panel panel-info">
					   <div class="panel-heading">
					      <h2 class="panel-title">'.$types_list[$type].'</h2>
					   </div>
					   <div class="panel-body"><ul>';
						  $n = 0;
					      foreach($article_group as $article){
					      	if($n > 5){
					      		echo '<br/>'.$this->Html->link('更多', array('controller' => 'articles', 'action' => 'view_more', $type));
					      		break;
					      	}else{
					      		echo '<li>'.$this->Html->link(__($article['Article']['name']), 
		        					array('controller' => 'articles', 'action' => 'view', $article['Article']['id']));
						      	echo '<br/>'.h($article['Article']['date']).'</li>';
						      	$n ++;
					      	}
					      }
					echo '</ul></div>
					</div>
				</div>';
			}?>
			</div>
		</div>
		<div class="col-md-3">
    		<?php 
			$options['suburbs'] = $suburbs;
			$options['ptypes'] = $ptypes_all;
			$options['price'] = 100;
			echo $this->Input->p_filter($options); 
			?>
		</div>
    </div>
</div>



