<?php 
	// Navigation Bar
	$this->Menu->navigation($role);
	// Breadcrumb
	$lists = '
		<li>'.$this->Html->link(__('诗歌列表'), 
			array('controller' => 'poems', 'action' => 'index')).'</li>
		<li class="active">添加诗歌</li>';
	$this->Menu->breadcrumb($lists);
	// Javascript
	echo $this->element('JS_richtext');
	$this->start('script');
	echo $this->Html->script('shortadd');
	$this->end();
?>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="form">
			<?php echo $this->Form->create('Poem'); ?>
				<fieldset>
					<legend><h2>添加诗歌</h2></legend>
				<?php
					echo $this->Form->input('number', array('label' => '编号', 'type' => 'text'));
					echo $this->Form->input('title', array('label' => '标题', 'type' => 'text'));
					echo $this->Form->input('content', array('label' => false, 'type' => 'textarea', 'id' => 'richtextarea1', 'before' => '<label for="richtextarea1">内容</label><br/>', 'rows' => 8));
					echo $this->Form->input('instruction', array('label' => false, 'type' => 'textarea', 'id' => 'richtextarea2', 'before' => '<label for="richtextarea2">解释</label><br/>', 'rows' => 8));
					echo $this->Form->input('poemcate_id', array('label' => '诗歌类别', 'type' => 'select', 'empty' => '请选择'));
					echo '<div id="poemtags">';
					echo $this->Field->multiCheckbox('Poemtag','标签', array('category_info' => 
						array('cate_list' => $poemtags, 'form_name' => 'Poemtag', 
							'checkbox_id' => 'PoemPoemtag')));
					echo '</div>';
					echo '<div class="well"><legend><h2>添加标签</h2></legend>';
					echo $this->Form->input('Tag.name', array('label' => '名称', 'type' => 'text'));
					echo $this->Form->input('Tag.poemtagcate_id', array('label' => '类别', 'type' => 'select', 'options' => $poemtagcates));
					echo $this->Form->button('添加', array('class' => 'btn btn-custom button-right', 'onclick' => 'this.disabled=true;shortadd();poemtags();this.disabled=false;return true;', 'type' => 'button'));
					echo $this->Form->button('刷新标签列表', array('class' => 'btn btn-custom button-right', 'onclick' => 'poemtags()', 'type' => 'button'));
					echo '</div>';
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>