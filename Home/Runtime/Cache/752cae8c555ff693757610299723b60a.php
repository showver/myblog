<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>新建博文</title>

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
<?php if($_SESSION['id']== null): ?><b><font color='red'>在右上角先登录后才能进入后台管理哦</font></b>
<?php else: ?>		
		
	<div id="blog_content" class="container-fluid">			
		<div class="row">		
		<!-- aside Section -->
			<aside class="aside col-xs-2">
				<div class="list-group">
					<a href="__URL__/back" id="mana_center" class="list-group-item list-group-item-danger btn">
						<h4 class="list-group-item-header">管理中心</h4>
					</a>
					<a href="__URL__/newcreateblog" id="new_blog" class="list-group-item list-group-item-warning btn active">
						<h4 class="list-group-item-header">新建博文</h4>
					</a>
					<a href="__URL__/blog_mana" id="mana_blog" class="list-group-item list-group-item-success btn">
						<h4 class="list-group-item-header">博文管理</h4>
					</a>
					<a href="#" id="mana_page" class="list-group-item list-group-item-info btn" data-toggle="popover" title="温馨提示：" data-content="此网页正在完善中" data-placement="top" data-trigger="focus">
						<h4 class="list-group-item-header">页面管理</h4>
					</a>
					<a href="__URL__/pinglun_mana" id="mana_comment" class="list-group-item list-group-item-danger btn">
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
			</aside><?php endif; ?>

		<!-- 2、new_blog_article -->
			<article class="new_blog_a col-xs-10">					
				<div class="form-inline">
					<button class="icon icon-tag btn btn-lg text-warning">新建博文</button>
				</div>
				<hr>
			<form action="<?php echo U('createblog');?>" method="post" class="form-inline">
				<div class="row">					
					<div class="col-xs-12 col-md-4">
						<div class="container-fluid">
							
								<div class="form-group">
									<label for="add_title">标题:</label>
									<input type="text" class="form-control" placeholder="请输入标题" id="add_title" name="blogtitle">
								</div>
							<input type="submit" name="titltsubmit" class="btn btn-md btn-primary visible-ms pull-right" value="提交文章"/>
							
						</div>
						<div class="container-fluid" style="background: #ccc; margin:20px 0;">							
							<div class="row">
								<label for="" class="">博文摘要（显示在博客主页）</label>
							</div>
							<div class="row">
								<textarea name="blogbar" cols="60" rows="10" style="resize: none; width: 100%;"></textarea>
							</div>
							<div class="row">
								
									<div class="form-group">							
										<label for="add_fl">分类:</label>
										<select name="add_fl" id="add_fl" class="form-control" style="width: 150px; height: 30px;">	
										<?php if(is_array($blogclass)): foreach($blogclass as $key=>$fl): ?><option value="<?php echo ($fl['c_id']); ?>"><?php echo ($fl['f_name']); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
								
								
									<div class="form-group" >
										<label for="add_zt">状态:</label>
										<select name="add_zt" id="add_zt" class="form-control" style="width: 150px; height: 30px;">
											<option value="0">公开</option>
											<option value="1">私密</option>
										</select>
									</div>
																				
							</div>
						</div>						
						<!-- <input type="submit" value="提交文章" name="titltsubmit1" class="btn btn-lg btn-primary center-block visible-md"/> -->				
					</div>
					<div class="col-xs-12 col-md-8">												
						<div class="form-group">
							<label for="">正文编辑</label>
							<textarea id="ke_content" name="blogcontent" cols="8" rows="40" style="width:100%; height: 400px;"></textarea>			
						</div>
					</div>
				</div>
			</form>
				<hr>
			</article>
		</div>
	</div>





		<footer class="row text-center" style="background: rgba(0,0,0,0.9); color: white">
			<span class="text-center">Copyright © 20018 myblog. All Rights Reserved</span><br>
			<span class="text-center">Powered by Yxiaowei Blog V1.0 Release 20170730</span>			
		</footer>

	
</body>			
</html>