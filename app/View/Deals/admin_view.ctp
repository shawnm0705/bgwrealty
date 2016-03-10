<?php 
	// Title	
	$this->assign('title', '查看联系记录');
	echo $this->Menu->admin();
?>

<div class="container">
	<div class="row">
		<?php 
		$status = $deal['Deal']['status'];
		$type = $status_types[$status];
		$id = $deal['Deal']['id'];
		echo $this->Html->link(__('返回列表'), array('action' => 'index', $type), array('class' => 'btn btn-custom button-action')); ?>
		<center><h1>销售明细</h1></center>
		<div class="col-md-8 col-md-offset-2">
			<dl class="dl-view dl-250">
				<?php
				echo '<dt>员工：</dt>
					<dd>'.h($deal['Employee']['name']).'&nbsp;</dd>
					<dt>客户：</dt>
					<dd>'.h($deal['Customer']['name']).'&nbsp;</dd>
					<dt>楼盘：</dt>
					<dd>'.h($deal['Property']['name']).'&nbsp;</dd>
					<h2>出合同</h2>
					<dt>记录时间</dt>
					<dd>'.h($deal['Deal']['c_date']).'&nbsp;</dd>
					<dt>房号</dt>
					<dd>'.h($deal['Deal']['c_unitno']).'&nbsp;</dd>
					<dt>合同价格</dt>
					<dd>'.h($deal['Deal']['c_htjg']).'&nbsp;</dd>
					<dt>优惠金额</dt>
					<dd>'.h($deal['Deal']['c_yhje']).'&nbsp;</dd>
					<dt>定金金额</dt>
					<dd>'.h($deal['Deal']['c_djje']).'&nbsp;</dd>
					<dt>定金帐户</dt>
					<dd>'.h($deal['Deal']['c_djzh']).'&nbsp;</dd>
					<dt>定金凭证</dt>
					<dd>';
					if($deal['Deal']['c_djpz']){
						echo $this->Html->link(__(h($deal['Deal']['c_djpz'])), array('employee' => false, 'files' => true, 'controller' => 'Deal', 'action' => $id, h($deal['Deal']['c_djpz'])), array('target' => '_blank', 'download' => h($deal['Deal']['c_djpz'])));
					}else{
						echo '无';
					}
					echo '&nbsp;</dd>
					<dt>购买目的</dt>
					<dd>'.h($deal['Deal']['c_gmmd']).'&nbsp;</dd>
					<dt>客户身份</dt>
					<dd>'.h($deal['Deal']['c_khsf']).'&nbsp;</dd>
					<h3>合同姓名1</h3>
					<dt>First Name</dt>
					<dd>'.h($deal['Deal']['c_htfn1']).'&nbsp;</dd>
					<dt>Last Name</dt>
					<dd>'.h($deal['Deal']['c_htln1']).'&nbsp;</dd>
					<h3>合同姓名2</h3>
					<dt>First Name</dt>
					<dd>'.h($deal['Deal']['c_htfn2']).'&nbsp;</dd>
					<dt>Last Name</dt>
					<dd>'.h($deal['Deal']['c_htln2']).'&nbsp;</dd>
					<dt>律师行</dt>
					<dd>'.h($deal['Deal']['c_lsh']).'&nbsp;</dd>
					<dt>律师姓名</dt>
					<dd>'.h($deal['Deal']['c_lsxm']).'&nbsp;</dd>
					<dt>律师电话</dt>
					<dd>'.h($deal['Deal']['c_lsdh']).'&nbsp;</dd>
					<dt>律师邮箱</dt>
					<dd>'.h($deal['Deal']['c_lsyx']).'&nbsp;</dd>
					<dt>律所地址</dt>
					<dd>'.h($deal['Deal']['c_lsdz']).'&nbsp;</dd>
					<dt>预约合同签定时间</dt>
					<dd>'.h($deal['Deal']['c_htsj']).'&nbsp;</dd>';
					if(h($deal['Deal']['q_date'])){
						echo '<h2>签合同</h2>
							<dt>记录时间</dt>
							<dd>'.h($deal['Deal']['q_date']).'&nbsp;</dd>
							<dt>合同签定时间</dt>
							<dd>'.h($deal['Deal']['q_htsj']).'&nbsp;</dd>
							<dt>10%余额时间</dt>
							<dd>'.h($deal['Deal']['q_10sj']).'&nbsp;</dd>
							<dt>10%余额金额</dt>
							<dd>'.h($deal['Deal']['q_10je']).'&nbsp;</dd>
							<dt>10%余额帐户</dt>
							<dd>'.h($deal['Deal']['q_10zh']).'&nbsp;</dd>
							<dt>10%余额凭证</dt>
							<dd>';
							if($deal['Deal']['q_10pz']){
								echo $this->Html->link(__(h($deal['Deal']['q_10pz'])), array('employee' => false, 'files' => true, 'controller' => 'Deal', 'action' => $id, h($deal['Deal']['q_10pz'])), array('target' => '_blank', 'download' => h($deal['Deal']['q_10pz'])));
							}else{
								echo '无';
							}
							echo '&nbsp;</dd>';
					}
					if(h($deal['Deal']['j_date'])){
						echo '<h2>交换合同</h2>
							<dt>记录时间</dt>
							<dd>'.h($deal['Deal']['j_date']).'&nbsp;</dd>
							<dt>合同时间</dt>
							<dd>'.h($deal['Deal']['j_htsj']).'&nbsp;</dd>
							<dt>律师回函</dt>
							<dd>';
							if($deal['Deal']['j_lshh']){
								echo $this->Html->link(__(h($deal['Deal']['j_lshh'])), array('employee' => false, 'files' => true, 'controller' => 'Deal', 'action' => $id, h($deal['Deal']['j_lshh'])), array('target' => '_blank', 'download' => h($deal['Deal']['j_lshh'])));
							}else{
								echo '无';
							}
							echo '&nbsp;</dd>
							<dt>合同首页</dt>
							<dd>';
							if($deal['Deal']['j_htsy']){
								echo $this->Html->link(__(h($deal['Deal']['j_htsy'])), array('employee' => false, 'files' => true, 'controller' => 'Deal', 'action' => $id, h($deal['Deal']['j_htsy'])), array('target' => '_blank', 'download' => h($deal['Deal']['j_htsy'])));
							}else{
								echo '无';
							}
							echo '&nbsp;</dd>';
					}
					if(h($deal['Deal']['d_date'])){
						echo '<h2>贷款申请</h2>
							<dt>记录时间</dt>
							<dd>'.h($deal['Deal']['d_date']).'&nbsp;</dd>
							<dt>申贷时间</dt>
							<dd>'.h($deal['Deal']['d_sdsj']).'&nbsp;</dd>
							<dt>贷款银行</dt>
							<dd>'.h($deal['Deal']['d_yh']).'&nbsp;</dd>
							<dt>贷款公司</dt>
							<dd>'.h($deal['Deal']['d_gs']).'&nbsp;</dd>
							<dt>贷款联系人</dt>
							<dd>'.h($deal['Deal']['d_lxr']).'&nbsp;</dd>
							<dt>联系人电话</dt>
							<dd>'.h($deal['Deal']['d_lxrdh']).'&nbsp;</dd>
							<dt>联系人邮箱</dt>
							<dd>'.h($deal['Deal']['d_lxryx']).'&nbsp;</dd>
							<dt>估价联系人</dt>
							<dd>'.h($deal['Deal']['d_gjlxr']).'&nbsp;</dd>
							<dt>联系人电话</dt>
							<dd>'.h($deal['Deal']['d_gjlxrdh']).'&nbsp;</dd>';
					}
					if(h($deal['Deal']['y_date'])){
						echo '<h2>验房</h2>
							<dt>记录时间</dt>
							<dd>'.h($deal['Deal']['y_date']).'&nbsp;</dd>
							<dt>验房时间</dt>
							<dd>'.h($deal['Deal']['y_sj']).'&nbsp;</dd>
							<dt>验房联系人</dt>
							<dd>'.h($deal['Deal']['y_lxr']).'&nbsp;</dd>
							<dt>验房人电话</dt>
							<dd>'.h($deal['Deal']['y_lxrdh']).'&nbsp;</dd>';
					}
					if(h($deal['Deal']['jf_date'])){
						echo '<h2>交房</h2>
							<dt>记录时间</dt>
							<dd>'.h($deal['Deal']['jf_date']).'&nbsp;</dd>
							<dt>交房时间</dt>
							<dd>'.h($deal['Deal']['jf_sj']).'&nbsp;</dd>
							<dt>交房联系人</dt>
							<dd>'.h($deal['Deal']['jf_lxr']).'&nbsp;</dd>
							<dt>交房人电话</dt>
							<dd>'.h($deal['Deal']['jf_lxrdh']).'&nbsp;</dd>';
					}
					if(h($deal['Deal']['cz_date'])){
						echo '<h2>出租管理</h2>
							<dt>出租管理公司</dt>
							<dd>'.h($deal['Deal']['cz_gs']).'&nbsp;</dd>
							<dt>出租管理联系人</dt>
							<dd>'.h($deal['Deal']['cz_glr']).'&nbsp;</dd>
							<dt>出租管理人电话</dt>
							<dd>'.h($deal['Deal']['cz_dh']).'&nbsp;</dd>
							<dt>出租管理人邮箱</dt>
							<dd>'.h($deal['Deal']['cz_yx']).'&nbsp;</dd>
							<dt>出租管理合同时间</dt>
							<dd>'.h($deal['Deal']['cz_htsj']).'&nbsp;</dd>
							<dt>出租广告时间</dt>
							<dd>'.h($deal['Deal']['cz_ggsj']).'&nbsp;</dd>
							<dt>租房合同时间</dt>
							<dd>'.h($deal['Deal']['cz_zfhtsj']).'&nbsp;</dd>
							<dt>出租金额</dt>
							<dd>'.h($deal['Deal']['cz_je']).'&nbsp;</dd>
							<dt>出租期限</dt>
							<dd>'.h($deal['Deal']['cz_qx']).'&nbsp;</dd>';
					}
				?>
			</dl>	
		</div>
	</div>
</div>
