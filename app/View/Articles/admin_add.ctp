<?php 
	// Title	
	$this->assign('title', '添加新文章');
	echo $this->Menu->admin();
	echo $this->element('JS_richtext');
?>

<div class="container">
	<div class="row">
		<?php echo $this->Html->link(__('返回列表'), array('action' => 'index'), array('class' => 'btn btn-custom button-action')); ?><br/>
		<div class="col-md-10 col-md-offset-1">
			<div class="form label-150">
			<?php echo $this->Form->create('Article'); ?>
				<fieldset>
					<h1>添加新文章</h1>
					<div class="input required"><label for="ArticleType">文章类型</label><select name="data[Article][type]" id="ArticleType">
						<option value="">--请选择--</option>
						<?php
						foreach($types_array as $cate => $type_array){
							echo '<optgroup label="'.$cate.'">';
							foreach($type_array as $value => $type){
								echo '<option value="'.$value.'">'.$type.'</option>';
							}
							echo '</optgroup>';
						}
						?>
						</select>
					</div>
				<?php
					echo $this->Form->input('name', array('label' => '文章名', 'type' => 'text', 'div' => array('class' => 'input text required')));
					echo $this->Form->input('suburb_id', array('label' => '相关区域', 'type' => 'select', 'options' => $suburbs, 'selected' => 0));
					echo $this->Form->input('property_id', array('label' => '相关楼盘', 'type' => 'select', 'options' => $properties, 'selected' => 0));
					echo $this->Form->input('content', array('label' => false, 'type' => 'textarea', 'id' => 'richtextarea', 'before' => '<label for="richtextarea">内容</label><br/>'));
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

