<html>
<head>
	<title>Sales Advise Form - 创富地产</title>
	<link type="image/x-icon" rel="icon" href="<?php echo $this->webroot;?>img/logo-small.png">
	<?php 
	//echo $this->Html->css(array('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', 'saf'));
	echo $this->Html->css(array('bootstrap.min.css', 'saf'));
	?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="div-logo"><?php echo $this->Html->image('logo.png', array('class' => 'logo'));?></div>
			</div>
			<div class="col-md-8">
				<div class="div-info">
					<?php 
					echo '<dl>
							<dt>电话:</dt><dd>'.$pages['电话'].'&nbsp;</dd>
							<dt>E-mail:</dt><dd>'.$pages['E-mail'].'&nbsp;</dd>
							<dt>地址:</dt><dd>'.$pages['地址'].'&nbsp;</dd>
						</dl>';?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="div-deal">
				<h2>Sales Advise Form</h2>
				<dl>
					<div class="col-md-3">
						<dt>客户姓名: </dt><dd><?php echo $deal['Customer']['name'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>联系电话: </dt><dd><?php echo $deal['Customer']['phone'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>客户邮箱: </dt><dd><?php echo $deal['Customer']['email'];?>&nbsp;</dd>
					</div>

					<div class="col-md-3">
						<dt>项目名称: </dt><dd><?php echo $deal['Property']['name'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>房号: </dt><dd><?php echo $deal['Deal']['c_unitno'];?>&nbsp;</dd>
					</div>

					<div class="col-md-3">
						<dt>合同价格: </dt><dd><?php echo $deal['Deal']['c_htjg'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>优惠金额: </dt><dd><?php echo $deal['Deal']['c_yhje'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>定金金额: </dt><dd><?php echo $deal['Deal']['c_djje'];?>&nbsp;</dd>
					</div>
					<div class="col-md-6">
						<dt>定金帐户: </dt><dd><?php echo $deal['Deal']['c_djzh'];?>&nbsp;</dd>
					</div>

					<div class="col-md-3">
						<dt>购买目的: </dt><dd><?php echo $deal['Deal']['c_gmmd'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>客户身份: </dt><dd><?php echo $deal['Deal']['c_khsf'];?>&nbsp;</dd>
					</div>
					<div class="col-md-6">
						<dt>合同姓名1: </dt><dd>First Name:&nbsp;<?php echo $deal['Deal']['c_htfn1'];?>&nbsp;
												Last Name:&nbsp;<?php echo $deal['Deal']['c_htln1'];?>&nbsp;</dd>
					</div>
					<div class="col-md-6">
						<dt>合同姓名2: </dt><dd>First Name:&nbsp;<?php echo $deal['Deal']['c_htfn2'];?>&nbsp;
												Last Name:&nbsp;<?php echo $deal['Deal']['c_htln2'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>律师行: </dt><dd><?php echo $deal['Deal']['c_lsh'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>律师姓名: </dt><dd><?php echo $deal['Deal']['c_lsxm'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>律师电话: </dt><dd><?php echo $deal['Deal']['c_lsdh'];?>&nbsp;</dd>
					</div>
					<div class="col-md-3">
						<dt>律师邮箱: </dt><dd><?php echo $deal['Deal']['c_lsyx'];?>&nbsp;</dd>
					</div>
					<div class="col-md-6">
						<dt>律所地址: </dt><dd><?php echo $deal['Deal']['c_lsdz'];?>&nbsp;</dd>
					</div>
					<div class="col-md-6">
						<dt>合同签定时间: </dt><dd><?php echo $deal['Deal']['c_htsj'];?>&nbsp;</dd>
					</div>
				</dl>
			</div>
		</div>
	</div>
</body>
</html>



