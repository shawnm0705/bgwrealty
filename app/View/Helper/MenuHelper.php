<?php

App::uses('AppHelper', 'View/Helper');

class MenuHelper extends AppHelper {
	public $helpers = array('Form','Html');

	public function navigation($role = null, $options = array()){	
		echo '<div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
	    	<div class="container-fluid">
	        <div class="navbar-header">
            <div class="div-logo">';
                echo $this->Html->image('logo.png').'</div>';
                echo $this->Html->link(__('谐调网'), '/',array('class' => 'navbar-brand'));            
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
					    谐调哲理诗<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('哲理诗集'), 
            					array('controller' => 'poems', 'action' => 'showbook')).'</li>
					    	<li>'.$this->Html->link(__('序号查询'), 
            					array('controller' => 'poems', 'action' => 'bynumber')).'</li>
					    	<li>'.$this->Html->link(__('分类查询'), 
            					array('controller' => 'poems', 'action' => 'bycate')).'</li>
					    	<li>'.$this->Html->link(__('内容查询'), 
            					array('controller' => 'poems', 'action' => 'bytag')).'</li>
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
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    谐调人生<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('生命在于谐调'), '#').'</li>
					    	<li>'.$this->Html->link(__('感悟哲语箴言'), '#').'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    谐调饮食<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('四性食物'), '#').'</li>
					    	<li>'.$this->Html->link(__('五味食物'), '#').'</li>
					    	<li>'.$this->Html->link(__('补益脏腑食物'), '#').'</li>
					    	<li>'.$this->Html->link(__('清利脏腑食物'), '#').'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    谐调拳<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('谐调拳基本功'), '#').'</li>
					    	<li>'.$this->Html->link(__('谐调太极拳'), '#').'</li>
					    	<li>'.$this->Html->link(__('谐调操'), '#').'</li>
					    	<li>'.$this->Html->link(__('谐调拳对打'), '#').'</li>
					    	<li>'.$this->Html->link(__('红捶'), '#').'</li>
					    	<li>'.$this->Html->link(__('老架'), '#').'</li>
					    	<li>'.$this->Html->link(__('二路'), '#').'</li>
					    	<li>'.$this->Html->link(__('炮捶'), '#').'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    谐调中医<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('中医查询系统'), '#').'</li>
					    	<li>'.$this->Html->link(__('中医病历'), '#').'</li>
				    	</ul>
			    	</li>
			    	<li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    谐调管理<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
					    	<li>'.$this->Html->link(__('管理系统'), '#').'</li>
					    	<li>'.$this->Html->link(__('管理思路'), '#').'</li>
					    	<li>'.$this->Html->link(__('管理模式'), '#').'</li>
					    	<li>'.$this->Html->link(__('管理方法'), '#').'</li>
					    	<li>'.$this->Html->link(__('医院管理'), '#').'</li>
				    	</ul>
			    	</li>';

            if($role == 'admin'){

            	echo '<div></div><li role="presentation" class="dropdown">
					    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
					    哲理诗编辑<span class="caret"></span></a>
					    <ul class="navbar-nav dropdown-menu" role="menu">
						    <li>'.$this->Html->link(__('诗歌列表'), 
	            				array('controller' => 'poems', 'action' => 'index')).'</li>
						    <li>'.$this->Html->link(__('诗歌类别'), 
	            				array('controller' => 'poemcates', 'action' => 'index')).'</li>
						    <li>'.$this->Html->link(__('标签列表'), 
	            				array('controller' => 'poemtags', 'action' => 'index')).'</li>
						    <li>'.$this->Html->link(__('标签类别'), 
	            				array('controller' => 'poemtagcates', 'action' => 'index')).'</li>
						</ul>
					</li>
					<li>'.$this->Html->link(__('退出登录'), 
	            		array('controller' => 'users', 'action' => 'logout')).'</li>';
            }

	    echo '</ul>
	    	</div>
	    </div></div>';
	    // Menu Margin
		if($role == 'admin'){
			echo '<div class="under-menu-admin"></div>';
		}else{
			echo '<div class="under-menu"></div>';
		}
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
