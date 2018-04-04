<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>评论详细内容</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
	<!-- font-awesome css -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.css">


	<!-- jquery js -->
	<script src="__PUBLIC__/js/jquery-3.2.1.min.js"></script>
 	<!-- kindeditor -->	
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/kindeditor/themes/default/default.css">
	<script charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="__PUBLIC__/kindeditor/lang/zh_CN.js"></script>
	

	<!-- 公用js -->
    <script src="__PUBLIC__/public.js"></script>	
	<!-- bootstrap js -->
	<script src="__PUBLIC__/js/bootstrap.min.js"></script>
  
</head>
<body style="overflow-y:scroll;">	
	<nav id="blog_nav" class="navbar navbar-inverse navbar-static-top" role="navigation" style="border-radius: 10px;">	
		<div class="container-fluid">				
			<div class="navbar-header">				
				<a class="navbar-brand" href="#">My Blog</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">切换导航</span>					
					<span class="icon-reorder" style="color: white;"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="__APP__/Index/index" class="">首页</a></li>

					<?php if(is_array($faclass)): foreach($faclass as $key=>$f): ?><li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo ($f['f_name']); ?><span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
						    <?php if($f['son'] == null): ?><li><a href="#">暂无分类</a></li>
					        <?php else: ?>
							<?php if(is_array($faclass[$key]['son'])): foreach($faclass[$key]['son'] as $key=>$son): ?><li><a href="__APP__/Index/headerclassson?sonid=<?php echo ($son['c_id']); ?>"><?php echo ($son['f_name']); ?></a></li><?php endforeach; endif; endif; ?>
						</ul>
					</li><?php endforeach; endif; ?>
															
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li style="margin-top: 15px;">
						<i class="icon-user icon-large icon-border" style="color: white;"></i>
						<b class="" style="color: white;">
							<?php if($_SESSION['username']== null): ?>欢迎你！游客
						    <?php else: ?>
						    欢迎你！<?php echo (session('username')); endif; ?>
						</b>
					</li>
					<li>
						<a href="__APP__/Myback/back">后台首页</a>
					</li>
					<?php if($_SESSION['username']!= null): ?><li>
							<a href="__APP__/Login/destroysession">注销</a>
						</li>
					<?php else: ?>
						<li>
							<a href="__APP__/Login/login">登录</a>
						</li><?php endif; ?>
					<li>
						<a href="__APP__/Index/index">博客首页</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<hr>
	
<div id="blog_content" class="container-fluid">			
		<div class="row">	
		
		左边栏目
		


	<div id="blog_content" class="container-fluid">			
		<div class="row">		
		<!-- aside Section -->
			<aside class="aside col-xs-2">
				<div class="list-group">
					<a href="__URL__/back" id="mana_center" class="list-group-item list-group-item-danger btn active">
						<h4 class="list-group-item-header">管理中心</h4>
					</a>
					<a href="__URL__/newcreateblog" id="new_blog" class="list-group-item list-group-item-warning btn">
						<h4 class="list-group-item-header">新建博文</h4>
					</a>
					<a href="__URL__/blog_mana" id="mana_blog" class="list-group-item list-group-item-success btn">
						<h4 class="list-group-item-header">博文管理</h4>
					</a>
					<a href="#" id="mana_page" class="list-group-item list-group-item-info btn" data-toggle="popover" title="温馨提示：" data-content="此网页正在完善中" data-placement="top" data-trigger="focus">
						<h4 class="list-group-item-header">页面管理</h4>
					</a>
					<a href="__URL__/pinglun_mana" id="mana_comment" class="list-group-item list-group-item-danger btn active">
						<h4 class="list-group-item-header">评论管理</h4>
					</a>
					<a href="__URL__/class_mana" id="mana_classify" class="list-group-item list-group-item-warning btn">
						<h4 class="list-group-item-header">分类管理</h4>
					</a>
					<a href="#" id="mana_tag" class="list-group-item list-group-item-success btn" data-toggle="popover" title="温馨提示：" data-content="此网页正在完善中" data-placement="top" data-trigger="focus">
						<h4 class="list-group-item-header">标签管理</h4>
					</a>
					<a href="__URL__/user_mana" id="mana_user" class="list-group-item list-group-item-info btn">
						<h4 class="list-group-item-header">用户管理</h4>
					</a>
				</div>
			</aside>
	
		<!-- 1、mana_center_article -->
			<article class="mana_center_a col-xs-10">
				<div class="center-block">
					<button class="icon icon-tag btn btn-lg text-danger">评论详情</button>
				</div>	
				<hr>
				<!-- panel -->
				<div class="row">	
					<form action="" class="form-horizontal" style="display:flex; justify-content:center; flex-flow:row wrap;">
						<table class="table-responable" style="margin-bottom:50px;">
							<tr>
								<td>评论者：
							       <div type="text" class="form-control"><?php echo ($comm[0]['user']); ?></div>
								</td>
							</tr>
							<tr style="margin-top:20px;">
								<td>评论内容：
							       <div class="form-control" style="resize:none;"><?php echo ($comm[0]['p_content']); ?></div></td>
							</tr>
							<tr style="margin-top:20px;">
								<td>评论时间：
							       <div type="text" class="form-control"><?php echo (date("Y-m-d",$comm[0]['p_pubtime'])); ?></div>
								</td>
							</tr>
						</table>
						
					</form>
				</div>
			</article>
			</div>
		</div>
	</div>



模态框



		<footer class="row text-center" style="background: rgba(0,0,0,0.9); color: white">
			<span class="text-center">Copyright © 20018 myblog. All Rights Reserved</span><br>
			<span class="text-center">Powered by Yxiaowei Blog V1.0 Release 20170730</span>			
		</footer>

	
</body>			
</html>