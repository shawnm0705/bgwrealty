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
            		<li>'.$this->Html->link(__('公司简介'), array('controller' => 'pages', 'action' => 'about')).'</li>
			    	<li>'.$this->Html->link(__('公司资讯'), array('controller' => 'pages', 'action' => 'info')).'</li>
			    	<li>'.$this->Html->link(__('项目汇总'), array('controller' => 'pages', 'action' => 'home')).'</li>
			    	<li>'.$this->Html->link(__('联系我们'), array('controller' => 'pages', 'action' => 'contact')).'</li>
			    	<li>'.$this->Html->link(__('加入我们'), array('controller' => 'pages', 'action' => 'join')).'</li>
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
	                echo $this->Html->link(__('管理员'), '#',array('class' => 'navbar-brand'));            
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
					    	<li>'.$this->Html->link(__('添加新病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看已有病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    客户管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看已有病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    团队管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看已有病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    业务管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新病例'), 
            					array('admin' => true, 'admin' => true, 'controller' => 'consultations', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看已有病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    用户管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新用户'), 
            					array('admin' => true, 'controller' => 'users', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看所有用户'), 
            					array('admin' => true, 'controller' => 'users', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    杂项管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看已有病例'), 
            					array('admin' => true, 'controller' => 'consultations', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    </ul>
	    	</div>
	    </div>
	    </div>';
	}

	public function doctor($options = array()){	
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
	    	<div class="container">
	        <div class="navbar-header">
            	<div class="div-logo">';
	                echo $this->Html->image('logo.pgn', array('class' => 'logo')).'</div>';
	                echo $this->Html->link(__('谐调-病例管理'), '#',array('class' => 'navbar-brand'));            
		    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
		    		<span class="sr-only">Toggle navigation</span>
		    		<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
	            </button>
	        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left" id="top-menu">';
            
            echo '<li>'.$this->Html->link(__('首页'),'/').'</li>
            		<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    病例管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('添加新病例'), 
            					array('controller' => 'consultations', 'action' => 'add')).'</li>
					    	<li>'.$this->Html->link(__('查看已有病例'), 
            					array('controller' => 'consultations', 'action' => 'index')).'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    谐调学<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('经'), '#').'</li>
					    	<li>'.$this->Html->link(__('纬'), '#').'</li>
					    	<li>'.$this->Html->link(__('论'), '#').'</li>
					    	<li>'.$this->Html->link(__('评'), '#').'</li>
					    	<li>'.$this->Html->link(__('用'), '#').'</li>
				    	</ul>
			    	</li>
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
