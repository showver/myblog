<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>

	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
	<link rel="stylesheet" href="__PUBLIC__/css/Validate.css">
	<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css">
	<script src="__PUBLIC__/js/jquery-3.2.1.min.js"></script>
	<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script src="__PUBLIC__/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
      $(function(){
         var validate=$("#registerform").validate({
            onfocusout:function(element){$(element).valid();},
         	rules:{
         		username:{
         			required:true,
         			remote:{
	         			type:"POST",
	         			url:"validate",
	         			dataType:'json',
	         			data:{
	         				username:function(){
	         				 return $("#username").val();
	         				}
	         			},
	         	    }     		
         		},
         		pwd:{
         			required:true,
         			rangelength:[5,16]
         		},
         		repwd:{
         			equalTo:"#pwd"
         		},
         		qq:{
         			required:true,
         			minlength:4,
         			digits:true
         		},
         		wx:{
         			required:true
         		}
         		
         	},
           
         	messages:{
         		username:{
         			required:"不能为空",
         			remote:"用户名被占用"
         		},
         		pwd:{
                    required: "不能为空",
                    rangelength: $.validator.format("密码由5-16个字组成")
                },
                repwd:{
                	required: "不能为空",
                	equalTo:"两次密码输入不一致"
                },
                qq:{
                    required:"不能为空",
                    digits: "只能输入整数",
                    minlength: $.validator.format("qq不能少于4个数")

                },
                wx:{
                	required:"不能为空"
                }
         	},

         });
      });
    </script>
</head>
<body style="background: rgba(0,0,0,0.05);">
	<div class="container" class="main" style="width:40vw; min-width: 250px; box-shadow: 0 0 10px rgba(0,0,0,0.6); padding:10px 80px; position: absolute; top:50%; left: 50%; transform: translate(-50%,-50%);">
		<h3 class="text-center" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.6);">注&nbsp;册</h3>
		<form class="form-horizontal" id="registerform" irole="form" style="font-size: 1.5rem; margin-top: 20px;" method="post" action="useradd">
			<div class="form-group">
			    <label for="username" class="col-sm-3 control-label">用户名</label>
			    <div class="col-sm-9">
			      	<input type="text" class="form-control" id="username" name="username" placeholder="张三" autofocus>
			      
			    </div>
			</div>
			<div class="form-group">
			    <label for="pwd" class="col-sm-3 control-label">密码</label>
			    <div class="col-sm-9">
			      	<input type="password" class="form-control" id="pwd" name="pwd" placeholder="请输入密码">
			    </div>
			</div>
			<div class="form-group">
			    <label for="repwd" class="col-sm-3 control-label">重输密码</label>
			    <div class="col-sm-9">
			      	<input type="password" class="form-control" id="repwd" name="repwd" placeholder="再次输入密码">
			    </div>
			</div>
			<div class="form-group">
			    <label for="qq" class="col-sm-3 control-label">QQ</label>
			    <div class="col-sm-9">
			      	<input type="text" class="form-control" id="qq" name="qq" placeholder="QQ">
			    </div>
			</div>
			<div class="form-group">
			    <label for="wx" class="col-sm-3 control-label">微信</label>
			    <div class="col-sm-9">
			      	<input type="text" class="form-control" id="wx" name="wx" placeholder="微信号">
			    </div>
			</div>

			<div class="form-group" style="display: flex; justify-content: center;">
		  		<input type="submit" name="registersub" class="btn btn-primary btn-sm" value="注&nbsp;册">
		  	</div>
			<p class="text-center">已经注册？？<a href="__URL__/login">登陆</a></p>
		</form>
	</div>
</body>
</html>