<?php 
header("Content-Type: text/html; charset=utf-8");
//开启session
session_start();
//数据库的连接
$mysqli=new mysqli("localhost","root","root","myblog") or die ("数据库连接失败！");
$mysqli->query("SET NAMES 'utf-8'");
?>