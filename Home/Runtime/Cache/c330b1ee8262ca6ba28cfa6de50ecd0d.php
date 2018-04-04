<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>博文管理</title>

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
					<a href="__URL__/blog_mana" id="mana_blog" class="list-group-item list-group-item-success btn active">
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
	
		<!-- 3、mana_blog_article -->
			<article class="mana_blog_a col-xs-10">
				<div class="center-block">
					<button class="icon icon-tag btn btn-lg text-success">博文管理</button>
				</div>	
				<hr>
				<div class="row">
					<form class="form-inline" action="__URL__/blog_manasousuo" method="get">
						<div class="input-group col-xs-3 col-xs-offset-1 pull-left">
							<span>
								<input type="text" placeholder="按标题搜索" class="form-control" name="titlesou">
								<!-- <span class="input-group-btn"> -->
									<button type="submit" style="height:34px;">搜索</button>
								<!-- </span> -->
							</span>
													
						</div>
						<div class="form-group col-xs-2 col-xs-offset-1">							
							<label for="search_fl">按分类:</label>
							<select name="blogclass">
							   <option value="0">全部</option>
							<?php if(is_array($blogclass)): foreach($blogclass as $key=>$cl): ?><option value="<?php echo ($cl['c_id']); ?>"><?php echo ($cl['f_name']); ?></option><?php endforeach; endif; ?>
							</select>
						</div>	
						<div class="form-group col-xs-2" >
							<label for="search_sj">按时间:</label>
							<select name="blogtime" id="search_sj" class="form-control">
								<option value="0">全部</option>
								<option value="3600*24">一天内</option>
								<option value="3600*24*3">三天前</option>
								<option value="3600*24*7">一周前</option>
							</select>
						</div>
						<div class="col-xs-2 col-xs-offset-1">
							<btn class="btn btn-danger" data-toggle="modal" data-target="#delect" onClick="blogdelarr()">删除所选</btn>							
						</div>																
					   </form>		
				</div>
				<hr>
				<div class="row">
					<table class="table table-hover table-bordered table-responsive" id="blogtable">
					  <thead>
						<tr class="">
							<th class="text-center">
							  
							   <input type="checkbox" id="b_cbAll" onclick="allcheackbox('b_cbAll')"/> 全选 
							 
							 </th>
							<th class="text-center">编号</th>
							<th class="text-center">博文标题</th>
							<th class="text-center">分类</th>
							<th class="text-center">发布日期</th>
							<th class="text-center">作者</th>
							<th class="text-center">操作</th>
						</tr>
					   </thead>
					   <tbody id="tb_b_cbAll">  
					    <?php if($sou == null): ?><tr>
								<td colspan="7" class="text-center text-muted">
									<p>暂无数据。。。。。。</p>
								</td>
					        </tr>
					    <?php else: ?>
							<?php if(is_array($sou)): foreach($sou as $key=>$con): ?><tr>
									<td class="text-center">
										<input type="checkbox" class="box" onClick="checkbox('b_cbAll')" value="<?php echo ($con['b_id']); ?>">
									</td>
									<td class="text-center"><?php echo ($con['b_id']); ?></td>
									<td class="text-center"><?php echo ($con['b_title']); ?></td>
									<td class="text-center"><?php echo ($con['f_name']); ?></td>
									<td class="text-center">
									      <b><font color='red'><?php echo (date("Y-m-d",$con['b_pubtime'])); ?></font></b>
									</td>
									<td class="text-center"><?php echo ($con['user']); ?></td>
									<td class="text-center">
										<a href="__APP__/Index/detail?bid=<?php echo ($con['b_id']); ?>"><button class="icon-leaf btn btn-success">详情</button></a>
										<button class="icon-edit btn btn-primary" data-toggle="modal" data-target="#edit_blog" onClick="blogedit(<?php echo ($con['b_id']); ?>)">编辑</button>
										<button class="icon-trash btn btn-danger" data-toggle="modal" data-target="#delect" onClick="blogdel(<?php echo ($con['b_id']); ?>)">删除</button>
									</td>
								</tr><?php endforeach; endif; endif; ?>
						</tbody> 
					</table>	
							
				</div>
             <?php if($page == '   '): if($sou == null): else: ?>
	               <script type="text/javascript">
				     var str="";
	                    str+="<tr>";
							str+="<td colspan='7' class='text-center text-muted'>";
								str+="<p>暂无更多数据。。。。。。</p>";
							str+="</td>";
					    str+="</tr>";
					   $('#tb_b_cbAll').append(str);
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



		<!-- 模态框	 mana_blog_edit -->
			<div role="dialog" class="modal fade" id="edit_blog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<i class="close icon-remove" data-dismiss="modal"></i>
							<h4 class="modal-title text-center">编辑博文</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal">
								<div class="form-group">
								<!-- 博文隐藏id -->
								    <input type="hidden" class="form-control" id="blogid">
								<!-- 博文编辑内容 -->
									<label class="col-xs-3 control-label">新的博文标题</label>
									<div class="col-xs-7">
										<input type="text" class="form-control" id="newtitle">
									</div>
								</div>
								<div class="form-group">									
									<label class="col-xs-3 control-label">分类</label>
									<div class="col-xs-7">
										<select class="form-control" id="blogselect">
											<?php if(is_array($blogclass)): foreach($blogclass as $key=>$cl): ?><option value="<?php echo ($cl['c_id']); ?>"><?php echo ($cl['f_name']); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
								</div>
				
					    <div class="form-group" >
							<label class="col-xs-3 control-label">正文编辑</label>
							<div class="col-xs-7">
								<textarea class="form-control" id="ke_content" style="width:100%; height: 400px; resize:none;"></textarea>
							</div>
										
						</div>
							
														
							</form>						
						</div>
						<div class="modal-footer">
							<div class="text-right">
								<button class="btn btn-primary" data-dismiss="modal" id="blogupdate">确认</button>
								<button class="btn btn-warning" data-dismiss="modal">取消</button>
							</div>							
						</div>
					</div>
				</div>
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
        /***3、向博文模态框编辑传值****/
        function blogedit(a){
          $.ajax({
          	type:"post",
          	url:"__URL__/blogmodel",
          	data:{"b_id":a},
          	success:function(b){
          		//alert(b[0]['b_content']);
          		 $("#blogid").val(b[0]['b_id']);
                 $("#newtitle").val(b[0]['b_title']);
                 editor.html(b[0]['b_content']);//向kindeditor传值
          	}
          })
         
        }
       /*3.拟态框编辑博文开始*/
        $("#blogupdate").click(function(){
        	//alert("ddddf");
            var newtitle=$("#newtitle").val();
            var blogid=$("#blogid").val();
            var blogselect=$("#blogselect").val();
            var blogkindeditor=editor.html();//获取kindeditor的值
             //alert(blogkindeditor);
            $.ajax({
              type:"post",
              url:"__URL__/blogupdate",
              data:{"newtitle":newtitle,"blogselect":blogselect,"blogid":blogid,"blogkindeditor":blogkindeditor},
              success:function(b){
                 //alert(b);
               window.location.reload();
              }
            })
        })



    /***3、删除博文****/
        function blogdel(d){
                if(confirm("确认要删除？")){ 
            //alert(d);
              $(this).click(function(){
                  $.ajax({
                    type:"post",
                    url:"__URL__/blogdel",
                    data:{"blogid":d},
                    success:function(){
                      alert("删除成功，正在跳转。。。");
                      window.location.reload();
                    }
                  })
              });
            } else{
              window.event.returnValue = false;
              }
        }


    /******3、删除选中博文********/
        function blogdelarr(){
         //获取全选的博文id 
                if($(".box").is(':checked')==0){
                  alert("请先选中复选框");
                }else{
                   if(confirm("确定删除所选？？")){
                     var blogid=""; 
                    $(".box").each(function() {
                      if ($(this).is(':checked')) {
                       blogid +=$(this).val()+","; //逐个获取id
                      }
                    });
                     var blogidarr=new Array();
                     blogidarr=blogid.split(",");
                     //alert(blogidarr);
                        $.ajax({
                        type:"post",
                        url:"__URL__/blogdelall",
                        data:{"blogidarr":blogidarr},
                        success:function(all){
                           alert("删除成功，正在跳转。。。");
                           window.location.reload();

                        }
                      })
                   }else{
                          window.event.returnValu =false;
                   }
                }
        }
       /* $('#edit_blog').off('shown.bs.modal').on('shown.bs.modal', function (e) {
          $(document).off('focusin.modal');//解决编辑器弹出层文本框不能输入的问题
        });*/
   </script>