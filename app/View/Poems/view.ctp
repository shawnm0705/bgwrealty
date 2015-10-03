<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '
		<li>'.$this->Html->link(__('诗歌列表'), 
			array('controller' => 'poems', 'action' => 'index')).'</li>
		<li class="active">查看诗歌</li>';
	$this->Menu->breadcrumb($lists);
?>

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="view poem">
			<center><h2>诗歌</h2>
				<div style="width:380px;">
					<div class="well" style="padding:20px;height:440px;">
						<div style="font-size:18px;">
						<?php echo $poem['Poem']['number'].'·'.$poem['Poem']['title'];?>
						</div>
						<?php echo $poem['Poem']['content'];?>
					</div>
				</div>
			</center>
				<h3>解释</h3>
				<div class="well">
					<?php echo $poem['Poem']['instruction'];?>
				</div>
				<h3>诗歌类别</h3>
				<?php echo $poem['Poemcate']['name'];?>
				<h3>标签</h3>
				<?php foreach($poemtags as $poemtag){
					echo $poemtag.'，&nbsp;';
				};?>
				<h3>添加时间</h3>
				<?php echo $poem['Poem']['time'];?>
			</div>
		</div>
	</div>
</div>