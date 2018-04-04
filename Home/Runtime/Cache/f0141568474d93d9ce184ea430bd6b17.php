<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登陆</title>

	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
	<link rel="stylesheet" href="__PUBLIC__/css/Validate.css">
	<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css">

	<script src="__PUBLIC__/js/jquery-3.2.1.min.js"></script>
	<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script src="__PUBLIC__/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
    $(function(){
		var validate=$("#loginform").validate({
		 onfocusout:function(element){$(element).valid();},
			rules:{
				yh:{
					required:true,
					remote:{
						type:"POST",
						url:"loginvalid",
						dataType:"json",
						data:{
							yh:function(){
								return $("#yh").val();
							}
						}
					}
				},
				mm:{
					required:true
				},
				verify:{
					required:true,
					remote:{
						type:"POST",
						url:"loginverify",
						dataType:"json",
						data:{
							verify:function(){
								return $("#verify").val();
							}
						}
					}
				}

			},
			messages:{
				yh:{
					required:"请填写用户名",
					remote:"没有该用户名，请重输"
				},
				mm:{
					required:"请填写密码"
				},
				verify:{
					required:"请填写验证码",
					remote:"验证码错误"
				}
			}
		});
    });
    </script>
</head>
<body style="background: rgba(0,0,0,0.05); ">
	<div class="container" class="main" style="width:40vw; min-width: 250px; box-shadow: 0 0 10px rgba(0,0,0,0.6); padding:10px 100px; position: absolute; top:50%; left: 50%; transform: translate(-50%,-50%);">
		<h3 class="text-center" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.6);">登&nbsp;陆</h3>
		
		<form class="form-horizontal" id="loginform" method="post" action="userlogin" style="font-size: 1.5rem;margin-top: 20px;">
		  <?php if($_COOKIE['yh']!= null): ?><div class="form-group">
				<input type="text" class="form-control" id="yh" name="yh" value="<?php echo (cookie('yh')); ?>" autofocus required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="mm" name="mm" value="<?php echo (cookie('mm')); ?>" required>
			</div>
		  <?php else: ?>
			<div class="form-group">
				<input type="text" class="form-control" id="yh" name="yh" placeholder="用户名/邮箱" autofocus required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="mm" name="mm" placeholder="输入密码" required>
			</div><?php endif; ?>
			<div class="form-group">
				<input type="password" class="form-control" id="verify" name="verify" placeholder="输入验证码"><img src='__URL__/verify/' onclick="this.src='__URL__/verify/'+Math.random()" />
			</div>
			<div class="form-group" style="display: flex; justify-content: space-around;">
        		<div class="checkbox">
		        	<label><input type="checkbox" name="remember" >记住密码</label>
		      	</div>
        		<button type="submit" class="btn btn-primary btn-sm" style="border-radius: 10px;" >登&nbsp;陆</button>
			</div>
			<p class="text-center">还没注册？？<a href="__URL__/register">注册</a>&nbsp;or&nbsp;<a href="forgot.html">忘记密码</a></p>
		</form>
	    
	</div>
</body>
</html>
<script type="text/javascript">
	
</script>