<?php 
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../repeat_code/manage_head.php");
?>
<head>
<link href="/css/share.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>个人中心</title>
<link type="text/css" rel="stylesheet" href="personal_index.css"/>
</head>
<body>
<div id="frame">
<?php
if(isset($_GET['id'])){$_SESSION['id']=$_GET['id'];}
require_once("../../repeat_code/nav.php");
//防止个人主页干扰
if(isset($_SESSION['person'])){unset($_SESSION['person']);}
?>
   <div id="page">
       <div class="personal_nav">
           <ul class="personal_nav_ul">
               <li class="li_1"><a href="#">个人中心</a></li>
               <li class="li_2"><a href="#">账户设置</a></li>
               <li class="li_3"><a href="#">资金管理</a></li>
               <li><a target="_blank" href="personal_show.php">个人主页</a></li>
           </ul>
       </div>
       <div class="container">
       </div>
   </div>
</div>
<script type="text/javascript">
//首次加载
$('.container').load('ajax_personal.php');</script>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 
//加载不同页面
  
  $(".personal_nav_ul > li:eq(0)").addClass("li_focus");

$(function(){
    $('.personal_nav_ul > li').click(function(){ 
	   $('.personal_nav_ul > li').removeClass("li_focus");
	   $(this).addClass("li_focus");
		 });
	 });
	 
$(function(){
    $('.li_3').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_funds.php');
		 }); 	 
	 });	

$(function(){
    $('.li_1').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_personal.php');
		 }); 	 
	 });	 

$(function(){
    $('.li_2').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_acount.php');
		 });
	 });
	 
	 //实现焦点
	 
$(function(){
    $('.tow_p').click(function(){ 
	   $('.tow > p').removeClass("tow_p_focus");
	   $(this).addClass("tow_p_focus");
		 }); 	 
	 }); 
});
</script>
