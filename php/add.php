<?php  
include('conf.php');
if(isset($_POST['add_btn'])){
$up_id=$_POST['option'];
$up_user=$_POST['up_user'];
$up_pwd=$_POST['up_pwd'];
$sql2="update `log_user`,`log_gro` set `user`=".$up_user.", `pwd`=".$up_pwd.", `date`=time(), `gro`=".$up_id." where `uid`=";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
</html>