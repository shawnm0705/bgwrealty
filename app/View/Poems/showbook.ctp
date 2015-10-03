<?php 
	// Navigation Bar
	$this->Menu->navigation($role);

	// Title	
	$this->assign('title', '哲理诗集');

?>
<div class="device-md visible-md device-lg visible-lg">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			<center>
				<iframe src="<?php echo $book_page;?>" backgroundcolor="transparent" background="transparent" width="1000" height="700" style="border:0;"></iframe>
			</center>
			</div>
		</div>
	</div>
</div>
<div class="device-sm visible-sm device-xs visible-xs">
	<div class="container-fluid text-center">
		<iframe src="<?php echo $book_page_small;?>" backgroundcolor="transparent" background="transparent" height="450" style="border:0;"></iframe>
	</div>
</div>