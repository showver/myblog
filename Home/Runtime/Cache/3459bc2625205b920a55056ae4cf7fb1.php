<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>分类管理</title>

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
					<a href="__URL__/newcreateblog" id="new_blog" class="list-group-item list-group-item-warning btn">
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
					<a href="__URL__/class_mana" id="mana_classify" class="list-group-item list-group-item-warning btn active">
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

		<!-- 6、mana_classify_article -->
			<article class="mana_classify_a col-xs-10">
				<div class="center-block">
					<button class="icon icon-tag btn btn-lg text-warning">分类管理</button>
				</div>	
				<hr>
				<div class="row">
					<div class="col-xs-offset-1 col-xs-2">
						<button class="btn btn-primary" data-toggle="modal" data-target="#add_classify">添加分类</button>
					</div>
				</div>
				<hr>
				<div class="row">
					<table class="table table-hover table-bordered table-responsive" id="classtable">
					<thead>
						<tr class="">
							<th class="text-center">序号</th>
							<th class="text-center">分类名称</th>
							<th class="text-center">父分类</th>
							<th class="text-center">添加日期</th>
							<th class="text-center">分类级别</th>
							<th class="text-center">操作</th>
						</tr>
					</thead>
					<tbody>
					    <?php if($addres == null): ?><tr>
								<td colspan="7" class="text-center text-muted">
									<p>暂无数据。。。。。。</p>
								</td>
					        </tr>
                        <?php else: ?>
						<?php if(is_array($addres)): foreach($addres as $key=>$v): ?><tr>
								<td class="text-center"><?php echo ($key); ?></td>
								<td class="text-center"><?php echo ($v["f_name"]); ?></td>
								<td class="text-center"><?php echo ($v["f_id"]); ?></td>
								<td class="text-center"><?php echo (date("Y-m-d",$v["add_time"])); ?></td>
						        <td class="text-center"> 
							        <?php switch($v["level"]): case "1": ?>一级分类<?php break;?>
							           <?php case "2": ?>二级分类<?php break;?>
							           <?php case "3": ?>三级分类<?php break; endswitch;?>
						        </td>
								<td class="text-center">
									<button class="icon-edit btn btn-primary" data-toggle="modal" data-target="#edit_classify" onclick="class_edit('<?php echo ($v["f_name"]); ?>',<?php echo ($v["c_id"]); ?>)">编辑</button>
									<button class="icon-trash btn btn-danger" onclick="classdel(<?php echo ($v["c_id"]); ?>)">删除</button>
								</td>
						    </tr><?php endforeach; endif; endif; ?>
					</tbody>						
					</table>
				</if>
				<?php if($page == '   '): if($addres == null): else: ?>
	               <script type="text/javascript">
				     var str="";
	                    str+="<tr>";
							str+="<td colspan='7' class='text-center text-muted'>";
								str+="<p>暂无更多数据。。。。。。</p>";
							str+="</td>";
					    str+="</tr>";
					   $('#classtable tbody').append(str);
					</script><?php endif; ?>
             <?php else: ?>
				<div class="row text-center">
					<nav aria-label="Page navigation">
						<ul class="pagination">
							<?php echo ($page); ?>					
						</ul>
					</nav>
				</div><?php endif; ?>
			</article>




		<!-- 模态框	 mana_classify_edit -->
			<div role="dialog" class="modal fade" id="edit_classify">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<i class="close icon-remove" data-dismiss="modal"></i>
							<h4 class="modal-title text-center">修改分类</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" id="">
								<div class="form-group">
									<label class="col-xs-3 control-label">分类名称</label>
									<div class="col-xs-7">
										<input type="text" class="form-control" id="fname">
										<input type="hidden" class="form-control" id="cid">
									</div>
								</div>
								<div class="form-group">									
									<label class="col-xs-3 control-label">父分类</label>
									<div class="col-xs-7">
										<select class="form-control" id="fid"> 
										<option value="0">顶级分类</option>
										<?php if(is_array($addfuclass)): foreach($addfuclass as $k=>$v): ?><option value="<?php echo ($v['path']); ?>" ><?php echo ($v['f_name']); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
								</div>								
							</form>						
						</div>
						<div class="modal-footer">
							<div class="text-right">
								<button class="btn btn-primary" data-dismiss="modal" id="classup">确认</button>
								<button class="btn btn-warning" data-dismiss="modal">取消</button>
							</div>							
						</div>
					</div>
				</div>
			</div>

		<!-- 模态框  mana_classfy_add -->
			<div role="dialog" class="modal fade" id="add_classify">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<i class="close icon-remove" data-dismiss="modal"></i>
							<h4 class="modal-title text-center">添加分类</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal">
								<div class="form-group">
									<label class="col-xs-3 control-label">分类名称</label>
									<div class="col-xs-7">
										<input type="text" class="form-control" id="addfuname">
									</div>
								</div>
								<div class="form-group">									
									<label class="col-xs-3 control-label">父分类</label>
									<div class="col-xs-7">
										<select class="form-control" id="addfuid">
											<option value="0">顶级分类</option>
											<?php if(is_array($addfuclass)): foreach($addfuclass as $key=>$vo): ?><option value="<?php echo ($vo["c_id"]); ?>"><?php echo ($vo["level"]); ?>级<?php echo ($vo["f_name"]); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
								</div>
								
								
							</form>						
						</div>
						<div class="modal-footer">
							<div class="text-right">
								<button class="btn btn-primary" data-dismiss="modal" onclick="addCla()">确认</button>
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
       /*******6、分类管理的编辑开始*/
		/*拟态框中的编辑开始*/
		function class_edit(fname,editid) {  
		    //在表格中提取数据
		    // var fname= document.getElementById("classtable").rows[(row+1)].cells[1].innerText;
		    //alert(editid);
		    //向模态框传值
		    //alert(cid);
		    $("#fname").val(fname);
		    $("#cid").val(editid);

		}
		
		$("#classup").click(function(){
			var fname=$("#fname").val();
			var path=$("#fid").val();
			var c_id=$("#cid").val();
			if(path!=0){
			var ares=path.split(",");
		    var f_id=ares[1];
		    var path=$("#fid").val()+","+c_id;
		    //alert(f_id)
			}else{
			var f_id=0;
			var path="0,"+c_id;
			//alert(path);
			}
			$.ajax({
				type:"post",
				url:"__URL__/classup",
				data:{"c_id":c_id,"f_id":f_id,"f_name":fname,"path":path},
				success:function(date){
					alert('修改成功！正在跳转');
					window.location.reload();
				}

			});
		})
	 /*6.拟态框添加分类开始*/
		function addCla(){
			var addfuname1=$('#addfuname').val();
			var addfuid1=$('#addfuid').val();
			//alert(addfuname1);
			$.ajax({
		        type:"post",
		        url:"__URL__/addClass",
		        data:{"addfuname":addfuname1,"addfuid":addfuid1},
		        success:function(add){
		        	window.location.reload();					
		        }
			});
		}

		function classdel(del){
            if(confirm('确定要删除该数据？')){
               $.ajax({
               	type:"post",
               	url:"__URL__/classdel",
               	data:{"c_id":del},
               	success:function(){
               		window.location.reload();
               	}
               });
            }else{
            	window.event.returnValue=false;
            }
		}
	</script>