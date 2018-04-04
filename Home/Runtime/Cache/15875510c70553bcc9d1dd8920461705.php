<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>用户管理</title>

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
					<a href="__URL__/pinglun_mana" id="mana_comment" class="list-group-item list-group-item-danger btn">
						<h4 class="list-group-item-header">评论管理</h4>
					</a>
					<a href="__URL__/class_mana" id="mana_classify" class="list-group-item list-group-item-warning btn">
						<h4 class="list-group-item-header">分类管理</h4>
					</a>
					<a href="#" id="mana_tag" class="list-group-item list-group-item-success btn" data-toggle="popover" title="温馨提示：" data-content="此网页正在完善中" data-placement="top" data-trigger="focus">
						<h4 class="list-group-item-header">标签管理</h4>
					</a>
					<a href="__URL__/user_mana" id="mana_user" class="list-group-item list-group-item-info btn active">
						<h4 class="list-group-item-header">用户管理</h4>
					</a>
				</div>
			</aside><?php endif; ?>

		<!-- 8、mana_user_article -->
			<article class="mana_user_a col-xs-10">
				<div class="center-block">
					<button class="icon icon-tag btn btn-lg text-primary">用户管理</button>
				</div>	
				<hr>
				<div class="row">
					<div class="col-xs-offset-1 col-xs-2">
						<button class="btn btn-primary" data-toggle="modal" data-target="#add_user">添加用户</button>
					</div>
				</div>
				<hr>
				<div class="row">
					<table class="table table-hover table-bordered table-responsive" id="table">
						<tr class="">
							<th class="text-center">编号</th>
							<th class="text-center">用户级别</th>
							<th class="text-center">用户名</th>
							<th class="text-center">密码</th>
							<th class="text-center">添加时间</th>
							<th class="text-center">操作</th>
						</tr>
                        
                    
					 <?php if(is_array($arr)): foreach($arr as $key=>$val): ?><tr id="tr_<?php echo ($val["id"]); ?>">
					        <td class='text-center' > <?php echo ($val["id"]); ?> </td>
							<td class='text-center' > <?php echo ($val["name"]); ?> </td>
							<td class='text-center' > <?php echo ($val["user"]); ?> </td>
							<td class='text-center' > <?php echo ($val["pwd"]); ?> </td>
							<td class='text-center'>  <?php echo (date("Y-m-d",$val["cretime"])); ?> </td>
							<td class='text-center'>
							 <button class='icon-edit btn btn-primary' data-toggle='modal' data-target='#edit_user' onclick='editInfo("tr_<?php echo ($val["id"]); ?>")'>
							          编辑</button>
							<button onclick='return del(<?php echo ($val["id"]); ?>)' class='icon-trash btn btn-danger'>删除</button>
							</td>
						</tr><?php endforeach; endif; ?> 
					</table>


				</div>
				<?php if($massage_page == null): else: ?>
				<div class="row text-center">
				    <nav aria-label="Page navigation">
						<ul class="pagination">
					            <li>
									<a href="#" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<?php $__FOR_START_13599__=0;$__FOR_END_13599__=$massage_page;for($i=$__FOR_START_13599__;$i < $__FOR_END_13599__;$i+=1){ ?><li><a href="__URL__/user_mana?page=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a></li><?php } ?> 	
								<li>
									<a href="#" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
						</ul>
					</nav> 
				</div><?php endif; ?>
			</article>



		<!-- 模态框  mana_user_add -->
           
			<div role="dialog" class="modal fade" id="add_user">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<i class="close icon-remove" data-dismiss="modal"></i>
							<h4 class="modal-title text-center">添加用户</h4>
						</div>
						<div class="modal-body">
						<?php if($_SESSION['gro']!= 0): ?><b><font color='red'>对不起，您的权限不足，可以联系管理员更改权限</font></b>
		                <?php else: ?>
							<form class="form-horizontal">
								 <div class="form-group">									
										<label class="col-xs-3 control-label">用户级别</label>
										<div class="col-xs-7">
											<select class="form-control" id="stuname" >
												<?php if(is_array($sel_gro)): foreach($sel_gro as $key=>$shell): ?><option  value="<?php echo ($shell["uid"]); ?>"><?php echo ($shell["name"]); ?></option><?php endforeach; endif; ?>
											</select>
										</div>
								  </div>
								<div class="form-group">
									<label class="col-xs-3 control-label">用户名称</label>
									<div class="col-xs-7">
										<input type="text" class="form-control" placeholder="" id="add_name" />
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-xs-3 control-label">用户密码</label>
									<div class="col-xs-7">
										<input type="password" class="form-control" id="add_pwd"  />									
									</div>
								</div>				
						</div>
						<div class="modal-footer">
							<div class="text-right">
								<button class="btn btn-primary" data-dismiss="modal" name="add_btn" onClick="useradd()">确认</button>
								<button class="btn btn-warning" data-dismiss="modal">取消</button>
							</div>							
						</div>
                        </form><?php endif; ?>
					</div>
				</div>
			</div>
		   
		<!-- 模态框  mana_user_edit -->
			<div role="dialog" class="modal fade" id="edit_user">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<i class="close icon-remove" data-dismiss="modal"></i>
							<h4 class="modal-title text-center">修改用户</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" action="__URL__/update" method="post">
								<div class="form-group">									
									<label class="col-xs-3 control-label">用户级别</label>
									<div class="col-xs-7" >
										<select class="form-control" id="stuno" name="opt_id">
											<?php if(is_array($sel_gro)): foreach($sel_gro as $key=>$shell): ?><option  value="<?php echo ($shell["uid"]); ?>"><?php echo ($shell["name"]); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
								<input type="hidden" id="hidden" name="hidden" />
									<label class="col-xs-3 control-label">用户名称</label>
									<div class="col-xs-7">
										<input type="text" class="form-control" placeholder="admin" name="up_user" value="" id="name"/>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-xs-3 control-label">用户密码</label>
									<div class="col-xs-7">
										<input type="password" class="form-control" name="up_pwd" id="pass"/>	
									</div>
								</div>						
						</div>
						<div class="modal-footer">
							<div class="text-right">
								<button class="btn btn-primary" data-dismiss="modal" name="up_butn" onClick="update()" >确认</button>
								<button class="btn btn-warning" data-dismiss="modal">取消</button>
							</div>							
						</div>
                        	</form>
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
	   /*-----	8、用户管理 删除  -----*/
		function del(uid){ 
			if(confirm("确认要删除？")){ 
			//alert(uid);
			$(this).click(function(){
				$.post("__URL__/del",{id:uid},function(){
					top.location.reload();
					});
				});
		      
			} else{
				window.event.returnValue = false;
				}
		} 


    /*8.拟态框中的用户管理的编辑开始*/
	    //提交更改  
		function update() {  
		    //获取模态框数据  
		    var str=$('#hidden').val();
		    //定义一数组
		    var strs= new Array(); 
		    //字符分割，分割出id
		        strs=str.split("_"); 
		    //id的值  
		    var id=strs[1];
		    //gro的gid
		    var stuno = $('#stuno').val();  
		    //用户的密码
		    var pass = $('#pass').val();
		    //用户名  
		    var name = $('#name').val();  
				  // alert(stuno);
			$.ajax({
				type:"post",
				url:"__URL__/update",
				data:{"idd":id , "stunoo":stuno , "passs": pass , "namee":name},
				//ajax成功后返回的数据
			  success:function(data){
				      //alert(data);
			    // data的值是json字符串，这行把字符串转成object  
			    var json = eval("("+data+")");
			    //移除Id为Result的表格里的行，从第二行开始（这里根据页面布局不同页变） 
			    $("#tr_"+json.id).remove();
			    //更新编辑后的表格以及值
			    var str ="";
			        str+="<tr id='tr_"+json.id+"'>";
					str+="<td class='text-center' >"+json.id+"</td>";
					str+="<td class='text-center' >"+json.name+"</td>";
					str+="<td class='text-center' >"+json.user+"</td>";
					str+="<td class='text-center' >"+json.pwd+"</td>";
					str+="<td class='text-center' >"+alltime(json.cretime)+"</td>";
					str+="<td class='text-center'>";
					str+="<button class='icon-edit btn btn-primary' data-toggle='modal' data-target='#edit_user' onclick='editInfo('tr_"+json.id+"')'> 编辑</button>";
					str+="<button onclick='return del("+json.id+")' class='icon-trash btn btn-danger'>删除</button>";
				   str+="</td></tr>";
				//将返回的数据追加到表格
			    $("#table").append(str);
			  }
			});
		} 

    /*8.back页面编辑*/
		function editInfo(obj) {  
		    var id =obj;
		       // alert(id);
		    //获取表格中的一行数据  
		    var pass = document.getElementById("table").rows[id].cells[3].innerText;  
		    var name = document.getElementById("table").rows[id].cells[2].innerText;  
		       //alert(name);
		    //向模态框中传值  
		    $('#pass').val(pass);  
		    $('#name').val(name);
		    $('#hidden').val(id);  
		    $('.modal fade').modal('show');  
		} 


    /*8.添加用户开始*/
		function useradd(){
			var str=$('#stuname').val();
			var adduser = $('#add_name').val();
			var addpwd = $('#add_pwd').val();
			
			$.ajax({
		    	type:"post",
		    	url:"__URL__/useradd",
		    	data:{"sel_gro":str,"add_user":adduser,"add_pwd":addpwd},
		    	success:function(){
		    	 /*window.reload(); */
					window.location.reload();
		    	}
		    });
		} 
</script>