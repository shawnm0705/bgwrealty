<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Title	
	$this->assign('title', '哲理诗内容查询');

?>

<div class="container-fluid">
	<div class="row h2 text-center">
		<div class="col-md-2 col-md-offset-3">内容查询</div><div class="col-md-4">《谐调学·哲理诗》</div>
	</div>
	<div class="text-center">
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#query_checkbox" aria-expanded="false" aria-controls="query_checkbox">
		 	点击选择内容标签进行查询
		</a>
		<div class="collapse" id="query_checkbox">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="poems-checkbox well">
						<?php
							echo $this->Form->create('Poem', array('type' => 'get'));
							echo $this->Field->multiCheckbox('Poemtag', '', array('category_info' => 
								array('cate_list' => $poemtags, 'form_name' => 'Poemtag', 'checkbox_id' => 'PoemPoemtag')));
							echo '<div class="div-button">';
							echo $this->Form->end(array('label' => '查询', 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => array('class' => 'div-button')));
							echo '</div>';
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="h2 text-center">查询结果</div>
		<div class="col-md-1"></div>
		<div class="col-md-10 well">
			<h3>			
			<?php
			if(isset($query_poemtags)){
				echo '查询标签：';
				$first_one = 1;
				if($query_poemtags){
					foreach($query_poemtags as $query_poemtag){
						if($first_one){
							echo $query_poemtag;	
							$first_one = 0;
						}else{
							echo ',&nbsp;'.$query_poemtag;	
						}
						
					}
				}else{
					echo '无';
				}
				echo '<div style="margin-top:20px;margin-bottom:20px;">查询结果：</div><div class="row">';
				if($poems_result){
					foreach($poems_result as $poem){
						$title = $poem['Poem']['title'];
						$number = $poem['Poem']['number'] + 4;
						echo '<div class="col-xs-12 col-sm-6 col-md-3">';
						echo $this->Html->link(h($title), array('action' => 'showbook', h($number)), array('class' => 'link-poem-title', 'target' => '_blank'));
						echo '</div>';
					}
				}else{
					echo '无结果';
				}
				echo '</div>';
			}else{
				echo '请点击上方按钮选择标签进行查询';
			}
			?></h3>
		</div>
	</div>
</div>