<?php
if($role == 'admin'){
	echo $this->element('Menu');
}
$this->start('css');
	echo $this->Html->css('c_home');
	$this->end();
	$this->start('script');
	echo $this->Html->script('c_home');
	$this->end();
?>

<div class="container">
	<div class="row" style="margin-top: 46px;">
        <div class="col-sm-6"><center>
            <div class="frames">
                <div class="sub_frames" role="tab" id="headingOne">
                    <center>
                        <h4 class="panel-title">                        	
                        	<?php echo $this->Html->link('<span class="heading">最新通告</span>', array('controller' => 'informs', 'action' => 'show'), array('id' => 'heading_link', 'escape' => false));?>                        	
                        </h4>
                    </center>
                </div>

            </div></center>
        </div>

        <div class="col-sm-6"><center>
            <div class="frames">
                <div class="sub_frames" role="tab" id="headingTwo">
                    <center>
                        <h4 class="panel-title">
                        	<?php echo $this->Html->link('<span class="heading">特价专区</span>', array('controller' => 'specials', 'action' => 'show'), array('id' => 'heading_link', 'escape' => false));?>
                        </h4>
                    </center>
                </div>
            </div>
        </div></center>
    </div>
	<?php
		$newline = 1;
		foreach($categories as $category_id => $category_name){
			if($newline){
				echo '<div class="row">';
				$newline = 0;
			}else{
				$newline = 1;
			}

            echo '<div class="col-md-6">
					<div class="frames">
		                <div class="sub_frames" role="tab" id="heading'.h($category_id).'">
		                    <center>
		                        <h4 class="panel-title">
									<a id="heading_link" class="collapsed" data-toggle="collapse" href="#collapse'.h($category_id).'" aria-expanded="false" aria-controls="collapse'.h($category_id).'"><span class="heading">'.h($category_name).'</span>
									</a>
								</h4>
		                    </center>
		                </div>
						<div class="panel-collapse collapse" id="collapse'.h($category_id).'" role="tabpanel" aria-labelledby="heading'.h($category_id).'">
							<div class="panel-body">';
					if(isset($productcates[$category_id])){
						$newrow = 1;
						foreach($productcates[$category_id] as $product_id => $product_name){
							if($newrow){
								echo '<div class="row">';
								$newrow = 0;
							}else{
								$newrow = 1;
							}
							echo '<div class="col-md-6">'.$this->Html->link(h($product_name), array('controller' => 'productcates', 'action' => 'show', h($product_id)), array('class' => 'links')).'</div>';
							if($newrow){
								echo '</div>';
							}
						}
						if(!$newrow){
							echo '</div>';
						}
					}
					echo '</div>
						</div>
					</div>
				</div>';

			if($newline){
				echo '</div>';
			}
		}
		if(!$newline){
			echo '</div>';
		}
	?>
	<center class="btn_pose">
		<?php echo $this->Html->link('退出登录', array('controller' => 'users', 'action' => 'logout'), array('class' => 'back_btns'));?>
		<br/>
		<br/>
    </center>
</div>