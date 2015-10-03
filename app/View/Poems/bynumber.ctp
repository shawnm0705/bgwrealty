<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Title	
	$this->assign('title', '哲理诗目录');

?>

<div class="container-fluid">
	<div class="row h2 text-center">
		<div class="col-md-2 col-md-offset-3">序号查询</div><div class="col-md-4">《谐调学·哲理诗》</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="poems-table">
				<div class="row">
					<div class="device-md visible-md device-lg visible-lg">
					  	<?php
						foreach($poems as $poem){
							$number = $poem['Poem']['number'] + 4;
							$title = $poem['Poem']['number'].'·'.$poem['Poem']['title'];
							$url = $this->Html->url(array('controller' => 'poems', 'action' => 'showbook', h($number)));
							echo '<div class="col-xs-12 col-sm-6 col-md-3"><a href="'.$url.'" class="link-poem-title" target="_blank">'.h($title).'</a></div>';
						}						
						?>
					</div>
					<div class="device-sm visible-sm device-xs visible-xs">
					  	<?php
						foreach($poems as $poem){
							$number = $poem['Poem']['number'] + 4;
							$title = $poem['Poem']['number'].'·'.$poem['Poem']['title'];
							$url = $this->Html->url(array('controller' => 'poems', 'action' => 'showbook', h($number)));
							echo '<div class="col-xs-12 col-sm-6 col-md-3"><a href="'.$url.'" class="link-poem-title">'.h($title).'</a></div>';
						}						
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>