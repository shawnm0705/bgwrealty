<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Title	
	$this->assign('title', '哲理诗分类');

?>

<div class="container-fluid">
	<div class="row h2 text-center">
		<div class="col-md-2 col-md-offset-3">分类查询</div><div class="col-md-4">《谐调学·哲理诗》</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">			
		  	<div class="device-md visible-md device-lg visible-lg">
				<div class="tabs poem-tabs">
					<ul class="nav nav-tabs poem-tab-headers" role="tablist">
						<?php
						foreach($poemcates as $id => $cate){
							echo '<li role="presentation"><a href="#l'.$id.'" aria-controls="l'.$id.'" role="tab" data-toggle="tab" style="padding: 10px 20px;">'.h($cate).'</a></li>';
						}
						?>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">				  	
					  	<?php
						foreach($poemcates as $id => $cate){
							echo '<div role="tabpanel" class="tab-pane fade" id="l'.$id.'"><div class="row">';
							if(isset($poems[$id])){
								foreach($poems[$id] as $number => $title){
									$number += 4;
									$url = $this->Html->url(array('controller' => 'poems', 'action' => 'showbook', h($number)));
									echo '<div class="col-xs-12 col-sm-6 col-md-3"><a href="'.$url.'" class="link-poem-title" target="_blank">'.h($title).'</a></div>';
								}
							}
							echo '&nbsp;</div></div>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="device-xs visible-xs device-sm visible-sm">
				<div class="tabs poem-tabs">
					<ul class="nav nav-tabs poem-tab-headers" role="tablist">
						<?php
						foreach($poemcates as $id => $cate){
							echo '<li role="presentation"><a href="#s'.$id.'" aria-controls="s'.$id.'" role="tab" data-toggle="tab" style="padding: 10px 20px;">'.h($cate).'</a></li>';
						}
						?>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">				  	
					  	<?php
						foreach($poemcates as $id => $cate){
							echo '<div role="tabpanel" class="tab-pane fade" id="s'.$id.'"><div class="row">';
							if(isset($poems[$id])){
								foreach($poems[$id] as $number => $title){
									$number += 4;
									$url = $this->Html->url(array('controller' => 'poems', 'action' => 'showbook', h($number)));
									echo '<div class="col-xs-12 col-sm-6 col-md-3"><a href="'.$url.'" class="link-poem-title">'.h($title).'</a></div>';
								}
							}
							echo '&nbsp;</div></div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>