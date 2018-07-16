<?php 
require_once("../repeat_code/head.php");
?>
<title><?php echo $_SESSION['session_nickname'];?>的个人中心-聚峰网</title>
<meta name="description" content="<?php echo $_SESSION['session_nickname'];?>的个人中心,聚峰网致力于打造最优秀的视频教程网站，开创软件教程|大学课程|学习资料三大板块，拥有平面教程，多媒体制作教程，办公信息化教程，机械设计教程，网站制作教程，各专业大学课程，课后答案，学习资料等多种优质资源。"/>
<meta name="keywords" content="视频教程，大学课程，学习资料，课后答案，聚峰网个人中心"/>
<link type="text/css" rel="stylesheet" href="personal_index.css"/>
</head>
<body>
<div id="frame">
<?php
if($_GET['is_success']=='T'){echo '<script type="text/javascript">
alert("充值成功");
</script>';}
require_once("../repeat_code/nav.php");
require_once("../repeat_code/member.php");
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
<?php require_once("../repeat_code/footer.php");?>
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
