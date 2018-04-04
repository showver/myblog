<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>博文详细页</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
	<!-- font-awesome css -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.css">
	
	<!-- jquery js -->
	<script src="__PUBLIC__/js/jquery-3.2.1.min.js"></script>
	<!-- bootstrap js -->
	<script src="__PUBLIC__/js/bootstrap.min.js"></script>

</head>



<body style="overflow-y:scroll; overflow-x:hidden;">


	<div id="content" class="container-fluid">
	<!-- header Section -->
		<header class="row">
			<ul class="nav nav-pills navbar-inverse navbar-static-top" style="border-radius: 10px;">
				<li role="presentation" class="btn btn-md">
					<a href="__APP__/Index/index_login" class="text-center">首页</a>
				</li>

                <?php if(is_array($faclass)): foreach($faclass as $key=>$f): ?><li role="presentation" class="btn btn-md dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
						<?php echo ($f['f_name']); ?><span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					    <?php if($f['son'] == null): ?><li><a href="#">暂无分类</a></li>
					    <?php else: ?>
					    <?php if(is_array($faclass[$key]['son'])): foreach($faclass[$key]['son'] as $key=>$son): ?><li><a href="__APP__/Index/headerclassson?sonid=<?php echo ($son['c_id']); ?>"><?php echo ($son['f_name']); ?></a></li><?php endforeach; endif; endif; ?>
					</ul>
				</li><?php endforeach; endif; ?>
				
				<ul class="btn btn-md pull-right">
					<li role="presentation" class="btn btn-md">
						<i class="icon-user icon-large icon-border" style="color: white;"></i>
						 <b class="text-center" style="color: white;">
						    <?php if($_SESSION['username']== null): ?>欢迎你！游客
						    <?php else: ?>
						    欢迎你！<?php echo (session('username')); endif; ?>
						  </b>
					</li>
					<li role="presentation" class="btn btn-md">
						<a href="__APP__/Myback/back">后台首页</a>
					</li>
					<?php if($_SESSION['username']!= null): ?><li role="presentation" class="btn btn-md">
							<a href="__APP__/Login/destroysession">注销</a>
						</li>
					<?php else: ?>
						<li role="presentation" class="btn btn-md">
							<a href="__APP__/Login/login">登录</a>
						</li><?php endif; ?>
					<li role="presentation" class="btn btn-md">
						<a href="__APP__/Index/index_login">博客首页</a>
					</li>
				</ul>				
			</ul>
		</header>
	</div>

<!-- welcome my blog -->
	<div class="container-fluid" >
		<div class="row">
			<div class="col-xs-offset-2 col-xs-1">
				<h1 class="text-primary" style="margin: 0;">Blog</h1>
			</div>
			<div class="col-xs-4" style="margin-top: 15px;">
				<h3 class="" style="margin: 0;">welcome my blog</h3>
			</div>			
		</div>
		<div class="row">
			<img src="__PUBLIC__/img/11.jpg" style="width: 100%">
		</div>
	</div>





<!-- content Section -->
	<div class="container">
		<div class="col-sm-offset-1 col-sm-7">
			<div class="row">
				<div class="col-sm-11" style="margin-bottom: -20px;">
				  <input id="bid" type="hidden" value="<?php echo ($blogdetail[0]['b_id']); ?>">
					<h3 class="text-danger" style="display: inline;"><strong><?php echo ($blogdetail[0]['b_title']); ?></strong></h3>
					<span class="label label-default pull-right"><?php echo (date("Y-m-d" ,$blogdetail[0]['b_pubtime'] )); ?></span>
					<hr style="margin-top: 0;">
				</div>
			</div>
			<div class="row" style="font-size: 16px;margin: 10px 0;">
					<div class="list-group-item">			
						<h5 class="text-primary" style="display: inline;"><strong>博文摘要：</strong></h5>	
							<?php echo ($blogdetail[0]['b_bar']); ?>
						<br>
					</div>
				</div>
			<div class="row" style="font-size: 16px; margin:0;">
				<?php echo ($blogdetail[0]['b_content']); ?>
			</div>
			<div class="row">				
				<ul class="list-inline list-unstyled pull-right" style="padding: 5px;">
				  <?php if($_SESSION['zan']!= null): ?><span class="label label-info" onClick="blogzan(<?php echo ($blogdetail[0]['b_id']); ?>)"><i id="zan" class="icon icon-thumbs-down"></i></span>
				  <?php else: ?>
				    <span class="label label-info" onClick="blogzan(<?php echo ($blogdetail[0]['b_id']); ?>)"><i id="zan" class="icon icon-thumbs-up" ></i></span><?php endif; ?>
					<li><span class="label label-danger">作者:<?php echo ($blogdetail[0]['user']); ?></span></li>
					<li><span class="label label-success"><i class="icon icon-eye-open"></i>浏览(<?php echo ($blogdetail[0]['look']); ?>)</span></li>
					<li><span id="littlezan" class="label label-success"><i class="icon icon-thumbs-up"></i>赞(<?php echo ($blogdetail[0]['zan']); ?>)</span></li>
					<li><span class="label label-primary">分类:<?php echo ($blogdetail[0]['f_name']); ?></span></li>
					<li><span class="label label-warning"><i class="icon icon-pencil"></i>评论(<?php echo ($blogdetail[0]['num']); ?>)</span></li>
				</ul>				
			</div>
			<div class="row">
				<h5><strong>博文最后一次修改时间为：<?php echo (date("Y-m-d" ,$blogdetail[0]['b_newtime'] )); ?></strong></h5>
			</div>
			<div class="row">
				<h4 class="text-success">评论列表:</h4>
				<hr style="margin:0 0 5px 0;">
				  <?php if($blogping == null): ?><div class="list-group">
						<div class="list-group-item">			
							<h5 class="text-primary" style="display: inline;"><strong>暂无评论数据。。。。。。</strong></h5>	
						</div>
				    </div>					
				  <?php else: ?>
					<?php if(is_array($blogping)): foreach($blogping as $key=>$p): ?><div class="list-group">
						<div class="list-group-item">			
							<h5 class="text-primary" style="display: inline;"><strong><?php echo ($p['user']); ?>：</strong></h5>	
								<?php echo ($p['p_content']); ?>
							<br>
							<span class="pull-right"><?php echo (date("Y-m-d",$p['p_pubtime'] )); ?></span>
						</div>
					</div><?php endforeach; endif; endif; ?>
				
			</div>
			<div class="row">
				<nav class="text-center">
				  <ul class="pagination">
				   <?php if($page == '   '): if($reping == null): else: ?>
		               <script type="text/javascript">
					     var str="";
		                     str+="<tr>";
								str+="<td colspan='7' class='text-center text-muted'>";
									str+="<p>暂无更多数据。。。。。。</p>";
								str+="</td>";
						     str+="</tr>";
						   $('#tb_p_cbAll').append(str);
						</script><?php endif; ?>
				    <?php else: ?>
						<div class="row text-center">
							<nav aria-label="Page navigation">
								<ul class="pagination">
									<?php echo ($page); ?>					
								</ul>
							</nav>
						</div><?php endif; ?>	
				  </ul>
				</nav>
			</div>
			<div class="row">
				<label>发表评论</label>
				<textarea style="resize: none; width: 100%;" cols="10" rows="5" id="p_content"></textarea>
				<button type="submit" class="btn btn-primary" id="pingsubmit">提交</button>
				</form>
			</div>		
		</div>

		<div class="col-sm-3 col-sm-offset-1">
			<div class="row">
				<form class="form-inline" action="__URL__/sousuo" method="post">
					<div class="form-group">
						<input type="text" name="blogkey">
						<button type="submit" class="btn btn-primary">搜索</button>
					</div>				
				</form>
			</div>
			<div class="row">
				<h4><strong>博客统计</strong></h4>
				<ul class="list-group">
				    <?php if($_SESSION['username']!= null): ?><li class="list-group-item">访问量：<strong><?php echo ($allmessage['look']); ?></strong></li>
					    <li class="list-group-item">博文总数：<strong><?php echo ($allmessage['blog']); ?></strong></li>
					    <li class="list-group-item">评论总数：<strong><?php echo ($allmessage['ping']); ?></strong></li>
					<?php else: ?>
						<li class="list-group-item">访问量：<strong>登录后查看</strong></li>
					    <li class="list-group-item">博文总数：<strong>登录后查看</strong></li>
					    <li class="list-group-item">评论总数：<strong>登录后查看</strong></li><?php endif; ?>					
					
				</ul>
			</div>
			<div class="row">
				<h4><strong>其他分类博客</strong></h4>
				<div class="col-sm-12">
					<button class="btn btn-default" style="margin:0 5px 10px;">Linux</button>
					<button class="btn btn-primary" style="margin:0 5px 10px;">Mysql</button>
					<button class="btn btn-success" style="margin:0 5px 10px;">Php</button>
					<button class="btn btn-danger" style="margin:0 5px 10px;">javascript</button>
					<button class="btn btn-info" style="margin:0 5px 10px;">html</button>
					<button class="btn btn-warning" style="margin:0 5px 10px;">css</button>
				</div>
			</div>

			<div class="row">
				<h4><strong>最热博文</strong></h4>
				<ul class="list-group">
					 <?php if(is_array($hotblog)): foreach($hotblog as $key=>$h): ?><li class="list-group-item" ><a href=""><?php echo ($h['b_title']); ?></a><span class="badge"><?php echo ($h['look']); ?></span></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="row">
				<h4><strong>联系我</strong></h4>
				<ul class="list-group">
					<li class="list-group-item">个人博客系统：<a href="">www.little_fish.com</a></li>
					<?php if($_SESSION['username']== null): ?><li class="list-group-item">个人QQ：<a href="">登录后查看</a></li>
					<?php else: ?>
					<li class="list-group-item">个人QQ：<a href=""><?php echo (session('QQ')); ?></a></li><?php endif; ?>
				</ul>
			</div>
			
		</div>
	</div>



	<footer class="row text-center" style="background: rgba(0,0,0,0.9); color: white">
		<span class="text-center">Copyright © 20018 myblog. All Rights Reserved</span><br>
		<span class="text-center">Powered by Yxiaowei Blog V1.0 Release 20170730</span>			
	</footer>

</body>
</html>


<script type="text/javascript">
	$('#pingsubmit').click(function(){
           var b_id=$("#bid").val();
           var p_content=$("#p_content").val();
           $.ajax({
           	   type:"post",
           	   url:"indexpinglun",
           	   data:{"b_id":b_id,"p_content":p_content},
           	   success:function(){
           	   	alert('评论成功，正在等待管理员审核中');
           	   	window.location.reload();
           	   }
           })
	});

	function blogzan(b){
		//alert(b);
		if($("#zan").hasClass("icon icon-thumbs-up")){
			$("#zan").attr( 'class', 'icon icon-thumbs-down');
	            $.ajax({
				type:"post",
				url:"__URL__/blogzan",
				data:{"b_id":b},
				success:function(z){
					$("#littlezan").text("");
					$("#littlezan").text("赞("+z+")").prepend("<i class='icon icon-thumbs-up'></i>");
			     }
		    }); 
		}else{
			$("#zan").attr('class','icon icon-thumbs-up');
			$.ajax({
				type:"post",
				url:"__URL__/blogquzan",
				data:{"b_id":b},
				success:function(z){
					$("#littlezan").text("");
					$("#littlezan").text("赞("+z+")").prepend("<i class='icon icon-thumbs-up'></i>");

			     }
		    }); 
			
		}
	}
</script>