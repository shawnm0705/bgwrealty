<?php

App::uses('AppHelper', 'View/Helper');

class MenuHelper extends AppHelper {
	public $helpers = array('Form','Html');

	public function homepage(){
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    	<div class="container">
	        <div class="navbar-header">
            	<div class="div-logo">';
	                echo $this->Html->image('logo.png', array('class' => 'logo')).'</div>';
		    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
		    		<span class="sr-only">Toggle navigation</span>
		    		<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left" id="top-menu">';
            
            echo '<li>'.$this->Html->link(__('首页'),'/').'</li>
            		<li>'.$this->Html->link(__('公司简介'), array('controller' => 'pages', 'action' =>'display', 'about')).'</li>
			    	<li>'.$this->Html->link(__('公司资讯'), array('controller' => 'pages', 'action' =>'display', 'info')).'</li>
			    	<li>'.$this->Html->link(__('楼盘汇总'), array('controller' => 'properties', 'action' => 'index')).'</li>
			    	<li>'.$this->Html->link(__('联系我们'), array('controller' => 'pages', 'action' =>'display', 'contact')).'</li>
			    	<li>'.$this->Html->link(__('加入我们'), array('controller' => 'pages', 'action' => 'display','join')).'</li>
			    </ul>
	    	</div>
	    </div>
	    </div>';
	}

	public function admin(){	
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    	<div class="container">
	        <div class="navbar-header">
            	<div class="div-logo">';
	                echo $this->Html->image('logo.png', array('class' => 'logo')).'</div>';           
		    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
		    		<span class="sr-only">Toggle navigation</span>
		    		<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left" id="top-menu">';
            
            echo '<li>'.$this->Html->link(__('首页'), array('admin' => true, 'controller' => 'pages', 'action' => 'home')).'</li>
            		<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    内容管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新文章'), 
            					array('admin' => true, 'controller' => 'articles', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('所有文章'), 
            					array('admin' => true, 'controller' => 'articles', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    客户管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新客户'), 
            					array('admin' => true, 'controller' => 'customers', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('所有客户'), 
            					array('admin' => true, 'controller' => 'customers', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    团队管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新员工'), 
            					array('admin' => true, 'controller' => 'employees', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('所有员工'), 
            					array('admin' => true, 'controller' => 'employees', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('添加新团队'), 
            					array('admin' => true, 'controller' => 'teams', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('所有团队'), 
            					array('admin' => true, 'controller' => 'teams', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('指导方案'), 
            					array('controller' => 'guidances', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    业务管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('在售清单'), 
            					array('controller' => 'deals', 'action' => 'index', 'ZS')).'</li>
					    	<li>'.$this->Html->link(__('成交清单'), 
            					array('controller' => 'deals', 'action' => 'index', 'CJ')).'</li>
					    	<li>'.$this->Html->link(__('客户联系记录'), 
            					array('controller' => 'contacts', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('员工计划'), 
            					array('controller' => 'plans', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('员工工作总结'), 
            					array('controller' => 'summaries', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('客户反馈'), 
					    		array('controller' => 'feedbacks', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    楼盘管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新楼盘'), 
            					array('admin' => true, 'controller' => 'properties', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('所有楼盘'), 
            					array('admin' => true, 'controller' => 'properties', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    帐号管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加客户帐号'), 
            					array('admin' => true, 'controller' => 'users', 'action' => 'add', 'customer')).'</li>
					    	<li>'.$this->Html->link(__('添加员工帐号'), 
            					array('admin' => true, 'controller' => 'users', 'action' => 'add', 'employee')).'</li>
					    	<li>'.$this->Html->link(__('添加管理员帐号'), 
            					array('admin' => true, 'controller' => 'users', 'action' => 'add', 'admin')).'</li>
					    	<li>'.$this->Html->link(__('所有帐号'), 
            					array('admin' => true, 'controller' => 'users', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    杂项管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('区域列表'), 
            					array('admin' => true, 'controller' => 'suburbs', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('户型列表'), 
            					array('admin' => true, 'controller' => 'ptypes', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('客户分类列表'), 
            					array('admin' => true, 'controller' => 'ctypes', 'action' => 'index', 'KHFL')).'</li>
					    	<li>'.$this->Html->link(__('客户来源列表'), 
            					array('admin' => true, 'controller' => 'ctypes', 'action' => 'index', 'KHLY')).'</li>
					    	<li>'.$this->Html->link(__('物业列表'), 
            					array('admin' => true, 'controller' => 'wys', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('律师列表'), 
            					array('admin' => true, 'controller' => 'lawyers', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('首页滚动图片'), 
            					array('admin' => true, 'controller' => 'pages', 'action' => 'slides')).'</li>
					    	<li>'.$this->Html->link(__('首页页面'), 
            					array('admin' => true, 'controller' => 'pages', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('公司信息'), 
            					array('admin' => true, 'controller' => 'pages', 'action' => 'info')).'</li>
					    	<li>'.$this->Html->link(__('自动邮件内容'), 
            					array('admin' => true, 'controller' => 'pages', 'action' => 'emessage')).'</li>
					    	<li>'.$this->Html->link(__('数据备份'), 
            					array('admin' => true, 'controller' => 'pages', 'action' => 'backup')).'</li>
				    	</ul>
			    	</li>
			    	<li>'.$this->Html->link(__('退出登录'), 
            					array('admin' => false, 'controller' => 'users', 'action' => 'logout')).'</li>
			    </ul>
	    	</div>
	    </div>
	    </div>';
	}

	public function employee(){	
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    	<div class="container">
	        <div class="navbar-header">
            	<div class="div-logo">';
	                echo $this->Html->image('logo.png', array('class' => 'logo')).'</div>';           
		    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
		    		<span class="sr-only">Toggle navigation</span>
		    		<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left" id="top-menu">';
            
            echo '<li>'.$this->Html->link(__('首页'), array('employee' => true, 'controller' => 'pages', 'action' => 'home')).'</li>
            		<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    内容管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新文章'), 
            					array('employee' => true, 'controller' => 'articles', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看我的文章'), 
            					array('employee' => true, 'controller' => 'articles', 'action' => 'myindex')).'</li>
					    	<li>'.$this->Html->link(__('查看所有文章'), 
            					array('employee' => true, 'controller' => 'articles', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    客户管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新客户'), 
            					array('employee' => true, 'controller' => 'customers', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('我的客户'), 
            					array('employee' => true, 'controller' => 'customers', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    业务管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('客户联系记录'), 
            					array('employee' => true, 'controller' => 'contacts', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('在售清单'), 
            					array('controller' => 'deals', 'action' => 'index', 'ZS')).'</li>
					    	<li>'.$this->Html->link(__('成交清单'), 
            					array('controller' => 'deals', 'action' => 'index', 'CJ')).'</li>
					    	<li>'.$this->Html->link(__('我的计划'), 
            					array('controller' => 'plans', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('我的工作总结'), 
            					array('controller' => 'summaries', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('我的指导方案'), 
            					array('controller' => 'guidances', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    楼盘管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('楼盘汇总'), 
					    		array('employee' => false, 'controller' => 'properties', 'action' => 'index'), 
					    		array('target' => '_blank')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    帐号管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('查看我的帐号信息'), 
            					array('employee' => true, 'controller' => 'employees', 'action' => 'view')).'</li>
				    	</ul>
			    	</li>
			    	<li>'.$this->Html->link(__('退出登录'), 
            					array('employee' => false, 'controller' => 'users', 'action' => 'logout')).'</li>
			    </ul>
	    	</div>
	    </div>
	    </div>';
	}

	public function leader(){	
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    	<div class="container">
	        <div class="navbar-header">
            	<div class="div-logo">';
	                echo $this->Html->image('logo.png', array('class' => 'logo')).'</div>';           
		    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
		    		<span class="sr-only">Toggle navigation</span>
		    		<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left" id="top-menu">';
            
            echo '<li>'.$this->Html->link(__('首页'), array('employee' => true, 'controller' => 'pages', 'action' => 'home')).'</li>
            		<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    内容管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新文章'), 
            					array('employee' => true, 'controller' => 'articles', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看我的文章'), 
            					array('employee' => true, 'controller' => 'articles', 'action' => 'myindex')).'</li>
					    	<li>'.$this->Html->link(__('查看所有文章'), 
            					array('employee' => true, 'controller' => 'articles', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    客户管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新客户'), 
            					array('employee' => true, 'controller' => 'customers', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('我的客户'), 
            					array('employee' => true, 'controller' => 'customers', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    团队管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('我的团队'), 
            					array('controller' => 'teams', 'action' => 'myteam')).'</li>
					    	<li>'.$this->Html->link(__('指导方案'), 
            					array('controller' => 'guidances', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    业务管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('客户联系记录'), 
            					array('employee' => true, 'controller' => 'contacts', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('在售清单'), 
            					array('controller' => 'deals', 'action' => 'index', 'ZS')).'</li>
					    	<li>'.$this->Html->link(__('成交清单'), 
            					array('controller' => 'deals', 'action' => 'index', 'CJ')).'</li>
					    	<li>'.$this->Html->link(__('我的计划'), 
            					array('controller' => 'plans', 'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('我的工作总结'), 
            					array('controller' => 'summaries', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    楼盘管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('楼盘汇总'), 
					    		array('employee' => false, 'controller' => 'properties', 'action' => 'index'), 
					    		array('target' => '_blank')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    帐号管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('查看我的帐号信息'), 
            					array('employee' => true, 'controller' => 'employees', 'action' => 'view')).'</li>
				    	</ul>
			    	</li>
			    	<li>'.$this->Html->link(__('退出登录'), 
            					array('employee' => false, 'controller' => 'users', 'action' => 'logout')).'</li>
			    </ul>
	    	</div>
	    </div>
	    </div>';
	}

	public function customer(){
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    	<div class="container">
	        <div class="navbar-header">
            	<div class="div-logo">';
	                echo $this->Html->image('logo.png', array('class' => 'logo')).'</div>';
		    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
		    		<span class="sr-only">Toggle navigation</span>
		    		<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left" id="top-menu">';
            
            echo '<li>'.$this->Html->link(__('首页'),'/').'</li>
            		<li>'.$this->Html->link(__('公司简介'), array('customer' => false,'controller' => 'pages', 
            			'action' =>'display', 'about')).'</li>
			    	<li>'.$this->Html->link(__('公司资讯'), array('customer' => false,'controller' => 'pages', 
			    		'action' =>'display', 'info')).'</li>
			    	<li>'.$this->Html->link(__('楼盘汇总'), array('customer' => false,'controller' => 'properties', 
			    		'action' => 'index')).'</li>
			    	<li>'.$this->Html->link(__('联系我们'), array('customer' => false,'controller' => 'pages', 
			    		'action' =>'display', 'contact')).'</li>
			    	<li>'.$this->Html->link(__('加入我们'), array('customer' => false,'controller' => 'pages', 
			    		'action' => 'display','join')).'</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    服务<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('研究报告'), array('customer' => true,'controller' => 'articles', 
					    		'action' => 'index')).'</li>
					    	<li>'.$this->Html->link(__('成交记录'), array('customer' => true,'controller' => 'deals', 
					    		'action' => 'view')).'</li>
					    	<li>'.$this->Html->link(__('服务反馈'), array('customer' => true,'controller' => 'feedbacks', 
					    		'action' => 'view')).'</li>
					    	<li>'.$this->Html->link(__('我的信息'), array('customer' => true,'controller' => 'customers', 
					    		'action' => 'view')).'</li>
				    	</ul>
			    	</li>
			    	<li>'.$this->Html->link(__('退出登录'), array('customer' => false, 'controller' => 'users', 
			    		'action' => 'logout')).'</li>
			    </ul>
	    	</div>
	    </div>
	    </div>';
	}

	public function breadcrumb($lists = null){
		echo '<div class="container-fluid">
			<div class="row">
				<div class="col-md-11">
					<ol class="breadcrumb">
					  <li>'.$this->Html->link(__('首页'), '/').'</li>
					  '.$lists.'
					</ol>
				</div>
				
			</div>
		</div>';
		/* <div class="col-md-1">
					<div style="text-align:right;margin-right:20px;">'.$this->Html->link(__('退出登录'), array('controller' => 'users', 'action' => 'logout')).'</div>
				</div>
				*/
	}

}
