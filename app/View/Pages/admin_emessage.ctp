<?php 
	// Title	
	$this->assign('title', '信息列表');
	echo $this->Menu->admin();
?>

<div class="container">
	<h1>自动邮件内容设置</h1>
	<?php foreach ($pages as $page): ?>
	<div class="row">
		<?php 
		echo '<h2>'.h($page['Page']['cate']).'</h2>&nbsp;'; 
		echo $this->Html->link(__('编辑'), array('action' => 'emessageedit', $page['Page']['id']), array('class' => 'btn btn-custom button-small'));
		?>
		<div class="index well">
			<?php echo $page['Page']['content']; ?>&nbsp;
		</div>	
	</div>
	<?php endforeach; ?>
</div>
