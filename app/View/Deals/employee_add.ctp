<?php 
	// Title	
	$this->assign('title', '添加销售信息');
	if($role == 'employee'){
		echo $this->Menu->employee();
	}elseif($role == 'leader'){
		echo $this->Menu->leader();
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="form label-250">
			<?php echo $this->Form->create('Deal', array('enctype' => 'multipart/form-data')); 
				echo '<fieldset>';
				echo $this->Form->hidden('status', array('value' => $status));
				echo '<h1>'.$status_list[$status].'</h1>';
				if($status != 'C'){
					echo $this->Form->input('id', array('value' => $id));
				}
				switch ($status){
					case 'C':
						echo $this->Form->input('customer_id', array('label' => '客户', 'type' => 'select', 'empty' => '---请选择---', 'options' => $customers, 'div' => array('class' => 'input required')));
						echo $this->Form->input('property_id', array('label' => '楼盘', 'type' => 'select', 'empty' => '---请选择---', 'options' => $properties, 'div' => array('class' => 'input required')));
						echo $this->Form->input('c_unitno', array('label' => '房号', 'type' => 'text'));
						echo $this->Form->input('c_htjg', array('label' => '合同价格', 'type' => 'text', 'value' => '$'));
						echo $this->Form->input('c_yhje', array('label' => '优惠金额', 'type' => 'text', 'value' => '$'));
						echo $this->Form->input('c_djje', array('label' => '定金金额', 'type' => 'text', 'value' => '$'));
						echo $this->Form->input('c_djzh', array('label' => '定金帐户', 'type' => 'textarea'));
						echo $this->Form->input('c_djpz', array('label' => '定金凭证', 'type' => 'file'));
						echo $this->Form->input('c_gmmd', array('label' => '购买目的', 'type' => 'select', 'empty' => '---请选择---', 'options' => array('投资' => '投资', '自住' => '自住')));
						echo $this->Form->input('c_khsf', array('label' => '客户身份', 'type' => 'select', 'empty' => '---请选择---', 'options' => array('PR/Citizen' => 'PR/Citizen', '海外人士' => '海外人士')));
						echo '<h2>合同姓名1 </h2>';
						echo $this->Form->input('c_htfn1', array('label' => 'First Name', 'type' => 'text'));
						echo $this->Form->input('c_htln1', array('label' => 'Last Name', 'type' => 'text'));
						echo '<h2>合同姓名2 </h2>';
						echo $this->Form->input('c_htfn2', array('label' => 'First Name', 'type' => 'text'));
						echo $this->Form->input('c_htln2', array('label' => 'Last Name', 'type' => 'text'));
						echo $this->Form->input('c_lsh', array('label' => '律师行', 'type' => 'text'));
						echo $this->Form->input('c_lsxm', array('label' => '律师姓名', 'type' => 'text'));
						echo $this->Form->input('c_lsdh', array('label' => '律师电话', 'type' => 'text'));
						echo $this->Form->input('c_lsyx', array('label' => '律师邮箱', 'type' => 'text'));
						echo $this->Form->input('c_lsdz', array('label' => '律所地址', 'type' => 'text'));
						echo $this->Input->date(array('label' => '预约合同签定时间', 'name' =>'data[Deal][c_htsj]', 
							'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						break;	
					case 'Q':
						echo $this->Input->date(array('label' => '合同签定时间', 'name' =>'data[Deal][q_htsj]', 
							'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Input->date(array('label' => '10%余额时间', 'name' =>'data[Deal][q_10sj]', 
							'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Form->input('q_10je', array('label' => '10%余额金额', 'type' => 'text', 'value' => '$'));
						echo $this->Form->input('q_10zh', array('label' => '10%余额帐户', 'type' => 'textarea'));
						echo $this->Form->input('q_10pz', array('label' => '10%余额凭证', 'type' => 'file'));
						break;
					case 'J':
						echo $this->Input->date(array('label' => '合同时间', 'name' =>'data[Deal][j_htsj]', 
							'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Form->input('j_lshh', array('label' => '律师回函', 'type' => 'file'));
						echo $this->Form->input('j_htsy', array('label' => '合同首页', 'type' => 'file'));
						break;
					case 'D':
						echo $this->Input->date(array('label' => '申贷时间', 'name' =>'data[Deal][d_sdsj]', 
								'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Form->input('d_yh', array('label' => '贷款银行', 'type' => 'text'));
						echo $this->Form->input('d_gs', array('label' => '贷款公司', 'type' => 'text'));
						echo $this->Form->input('d_lxr', array('label' => '贷款联系人', 'type' => 'text'));
						echo $this->Form->input('d_lxrdh', array('label' => '联系人电话', 'type' => 'text'));
						echo $this->Form->input('d_lxryx', array('label' => '联系人邮箱', 'type' => 'text'));
						echo $this->Form->input('d_gjlxr', array('label' => '估价联系人', 'type' => 'text'));
						echo $this->Form->input('d_gjlxrdh', array('label' => '联系人电话', 'type' => 'text'));
						break;	
					case 'Y':
						echo $this->Input->date(array('label' => '验房时间', 'name' =>'data[Deal][y_sj]', 
								'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Form->input('y_lxr', array('label' => '验房联系人', 'type' => 'text'));
						echo $this->Form->input('y_lxrdh', array('label' => '联系人电话', 'type' => 'text'));
						break;	
					case 'JF':
						echo $this->Input->date(array('label' => '交房时间', 'name' =>'data[Deal][jf_sj]', 
								'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Form->input('jf_lxr', array('label' => '交房联系人', 'type' => 'text'));
						echo $this->Form->input('jf_lxrdh', array('label' => '联系人电话', 'type' => 'text'));
						break;	
					case 'CZ':
						echo $this->Form->input('cz_gs', array('label' => '出租管理公司', 'type' => 'text'));
						echo $this->Form->input('cz_glr', array('label' => '出租管理人', 'type' => 'text'));
						echo $this->Form->input('cz_dh', array('label' => '管理人电话', 'type' => 'text'));
						echo $this->Form->input('cz_yx', array('label' => '管理人邮箱', 'type' => 'text'));
						echo $this->Input->date(array('label' => '管理合同签定时间', 'name' =>'data[Deal][cz_htsj]', 
								'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Input->date(array('label' => '出租广告时间', 'name' =>'data[Deal][cz_ggsj]', 
								'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Input->date(array('label' => '租房合同签定时间', 'name' =>'data[Deal][cz_zfhtsj]', 
								'year_min' => 1, 'year_selected' => date('Y'), 'month_selected' => date('m')));
						echo $this->Form->input('cz_je', array('label' => '出租金额', 'type' => 'text', 'value' => '$'));
						echo $this->Form->input('cz_qx', array('label' => '出租期限', 'type' => 'text'));
						break;	
				}
					
				?>
				</fieldset>
			<?php echo $this->element('Submit'); ?>
			</div>
		</div>
	</div>
</div>

