<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>评论管理</title>

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
			
		<!-- aside Section -->
			<aside class="aside col-xs-2">
				<div class="list-group">
					<a href="__URL__/back" id="mana_center" class="list-group-item list-group-item-danger btn">
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
			</aside><?php endif; ?>

		<!-- 5、mana_comment_article -->
			<article class="mana_comment_a col-xs-10">
				<div class="center-block">
					<button class="icon icon-tag btn btn-lg text-danger">评论管理</button>
				</div>	
				<hr>
				<div class="row">
					<form class="form-inline" action="__URL__/blogpinglunkey" method="get">
						<div class="col-xs-offset-1 col-xs-2">
							<a class="btn btn-md btn-info" href="__URL__/noshenhe"><i class="icon-comment"></i>待审核</a>
						</div>						
						<div class="col-xs-3">
							<div class="input-group">
								<span>
									<input type="text" placeholder="搜索关键字" class="form-control" name="pinglunkey">
									<button type="submit" style="height:34px;">搜索</button>
							    </span>
							</div>
						</div>
						<div class="form-group col-xs-3" >
							<label for="search_sj">按时间:</label>
							<select name="pingluntime"class="form-control">
								<option value="0">全部</option>
								<option value="3600*24">一天内</option>
								<option value="3600*24*3">三天前</option>
								<option value="3600*24*7">一周前</option>
									
							</select>
						</div>
						<div class="btn-group">								
							<button type="button" class="btn btn-md btn-danger" data-toggle="modal" data-target="#delect" onclick="pinglundelarr()">批量删除</button>
						</div>
					</form>					
				</div>
				<hr>
				<div class="row">
					<table class="table table-hover table-bordered table-responsive">
					  <thead>
						<tr class="">
							<th class="text-center"><input id="p_cbAll" onclick="allcheackbox('p_cbAll')" type="checkbox">全选</th>
							<th class="text-center">ID</th>
							<th class="text-center">评论内容</th>
							<th class="text-center">发布日期</th>
							<th class="text-center">评论者</th>
							<th class="text-center">操作</th>
						</tr>
					  </thead>
					  <tbody id="tb_p_cbAll">
					  <?php if($pingsou == null): ?><tr>
							<td colspan="7" class="text-center text-muted">
								<p>暂无数据。。。。。。</p>
							</td>
				        </tr>
					  <?php else: ?>
					    <?php if(is_array($pingsou)): foreach($pingsou as $key=>$p): ?><tr>
								<td class="text-center">
									<input type="checkbox" onClick="checkbox('p_cbAll')" class="box_p_cbAll" value="<?php echo ($p['p_id']); ?>">
								</td>
								<td class="text-center"><?php echo ($p['p_id']); ?></td>
								<td class="text-center"><?php echo ($p['p_content']); ?></td>
								<td class="text-center"><b><font color='red'><?php echo (date("Y-m-d",$p['p_pubtime'] )); ?></font></b></td>
								<td class="text-center"><?php echo ($p['user']); ?></td>
								<td class="text-center">
									<a href="__URL__/comm_check?p_id=<?php echo ($p['p_id']); ?>">
										<i class="icon-leaf btn btn-primary">查看</i>
									</a>

									<?php if($p['p_zhuangtai'] == '1'): ?><i id="renew<?php echo ($p['p_id']); ?>" onClick="renew(<?php echo ($p['p_zhuangtai']); ?>,<?php echo ($p['p_id']); ?>)" class="icon-remove btn btn-warning">屏蔽</i>
									<?php else: ?>
									  <i id="renew<?php echo ($p['p_id']); ?>" onClick="renew(<?php echo ($p['p_zhuangtai']); ?>,<?php echo ($p['p_id']); ?>)" class="icon-ok btn btn-success">恢复</i><?php endif; ?>

									<i id="pinglundel" class="icon-trash btn btn-danger" data-toggle="modal" data-target="#delect" onClick="pinglundel(<?php echo ($p['p_id']); ?>)">删除</i>
								</td>
						    </tr><?php endforeach; endif; endif; ?>
                      <tbody>
					</table>
				</div>
				<?php if($page == '   '): if($pingsou == null): else: ?>
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
				<div class="row text-center" id="blogpage">
					<nav aria-label="Page navigation">
						<ul class="pagination">
								<?php echo ($page); ?>				
						</ul>
					</nav>
				</div><?php endif; ?>	
			</article>
		</div>
	</div>





		<footer class="row text-center" style="background: rgba(0,0,0,0.9); color: white">
			<span class="text-center">Copyright © 20018 myblog. All Rights Reserved</span><br>
			<span class="text-center">Powered by Yxiaowei Blog V1.0 Release 20170730</span>			
		</footer>

	
</body>			
</html>

  
 <script type="text/javascript">
      /*-----  5、评论 删除------*/
        function pinglundel(d){
           if(confirm('确认要删除该数据？')){
           	   $.ajax({
                   type:"post",
                   url:"__URL__/pinglundel",
                   data:{"p_id":d},
                   success:function(){
                        window.location.reload();
                   }
           	   });
           }else{
           	window.event.returnValue=false;
           }
        }
      /*******5、批量删除评论************/
        function pinglundelarr(){
           if($(".box_p_cbAll").is(':checked')==0){
                alert("请先选中复选框先！");
           }else{
                if(confirm("确认要删除选中的数据？")){
                    var p_id="";
                    $(".box_p_cbAll").each(function(){
                       if($(this).is(':checked')){
                         p_id+=$(this).val()+",";
                       }
                    });
                        var pidarr=new Array();
                            pidarr=p_id.split(',');
                        $.ajax({
                            type:"post",
                            url:"__URL__/pinglundelarr",
                            data:{"pidarr":pidarr},
                            success:function(){
                                window.location.reload();
                            }
                        });
    
                }else{
                    window.event.returnValue=false;
                }
           }
        }
         

       /*-----  5、屏蔽 恢复  ------*/
        function renew(p,i){
                //alert("#renew"+i);
                if ($("#renew"+i).hasClass('icon-ok btn btn-success')) {
                    $("#renew"+i).attr( 'class', 'icon-remove btn btn-warning' );
                    $("#renew"+i).text('屏蔽');
                    var p_zhuangtai=1;
                    $.ajax({
                        type:"post",
                        url:"__URL__/p_zhuangtai",
                        data:{"p_id":i,"p_zhuangtai":p_zhuangtai},
                    });
                                
                }else {
                    $("#renew"+i).attr( 'class', 'icon-ok btn btn-success');
                    $("#renew"+i).text('恢复');   
                    var p_zhuangtai=0;
                    $.ajax({
                        type:"post",
                        url:"__URL__/p_zhuangtai",
                        data:{"p_id":i,"p_zhuangtai":p_zhuangtai},
                    });
                }
        }

 </script>