<?php
require_once("../repeat_code/head.php");
if(isset($_SESSION['session_user_id'])){echo '<script type="text/javascript">
window.location.href="/personal_index/personal_index.php";
</script>';}
?>
<title>登录-聚峰网</title>
<meta name="description" content="聚峰网登陆,聚峰网致力于打造最优秀的视频教程网站，开创软件教程|大学课程|学习资料三大板块，拥有平面教程，多媒体制作教程，办公信息化教程，机械设计教程，网站制作教程，各专业大学课程，课后答案，学习资料等多种优质资源。"/>
<meta name="keywords" content="视频教程，大学课程，学习资料，课后答案，聚峰网登陆"/>
<link href="login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/baidutongji.js"></script>
</head>

<body>
 <div class="login_one">
     <div class="logo_container">
      <img alt="聚峰网登录" class="logohaha" src="../image/LOGO.gif" height="61" width="150">
     </div>
 </div>
 <div class="login_two">
    <div class="login_two_left">
       <img alt="聚峰网登录" src="/image/log.gif" width="480" height="370">
    </div>
    <div class="login_box_container">
  <div class="login_box">
<form id="log_in_form" action="/login/log_in_php.php" method="post">
   <div class="loginTitle">
     <p class="top_login">会员登录</p>
   </div>
    <div class="loginTextUserName rowLogin">
         <p class="loginBiaoQian">账号*</p>
         
                    <input value="<?php require_once("../repeat_code/session_start.php"); echo $_SESSION['log_in_zhanghao'];?>" type="text" class="loginInputText" id="zhanghao" name="zhanghao" />
         
    </div> 
    <div class="loginTextPassWord rowLogin">
         <p class="loginBiaoQian">密码*</p>
         
                    <input type="password" class="loginInputText" id="password" name="password" />
         
    </div>
    <div class="loginTextAdmin">
       <div class="loginTextAdminLeft rowLogin">
            <p class="loginBiaoQian">验证码*</p>
         
                    <input type="text" class="loginInputTextAdmin" id="get_check_number" name="get_check_number" />
       
       </div>
       <div class="loginTextAdminRight">
        <a href="#"><img alt="聚峰网登录验证码" id="img" title="看不清，换一张" src="../repeat_code/captcha.php" onClick="this.src = this.src + '?' + new Date().getTime();"  /></a>
       </div>
    </div>
    <div class="loginSubmit">
    <div class="login_a">
    <a href="../login/sign_in.php">注册</a>
    <a href="../login/forgot_password.php">找回密码</a>
    </div>
                    <input type="submit" id="log_in_submit" name="log_in_submit" class="loginInputSubmit" value="登&nbsp&nbsp&nbsp录" />


    </div></form> 
   <script type="text/javascript"> 
//登录
$(document).ready(dosomething0);
function dosomething0()
{

//账号验证
$('#zhanghao').bind
	('blur',function()
	{
		var zhanghao=$(this);
		zhanghao.next('span').remove();
		zhanghao.after('<span class="zhanghao_message"></span>');
	var data3=$('#zhanghao').serialize();
	$.post('/login/ajax_log_in_account.php',data3,function(data3){
if(data3=='√'){$('#zhanghao').css("color","#0F0");}
if(data3=='×'){$('#zhanghao').css("color","#F00");}		/*$('.zhanghao_message').html(data3);*/
		},'html');	
	}
	);

//密码验证	
$('#password').focus(function(){$('#password').css("color","#000");});
$('#password').bind
	('blur',function()
	{
		var password=$(this);
		password.next('span').remove();
		password.after('<span class="password_message"></span>');
	var data3=$('#password').serialize();
	$.post('/login/ajax_log_in_password.php',data3,function(data3){
if(data3=='√'){$('#password').css("color","#0F0");}
if(data3=='×'){$('#password').css("color","#F00");}	
		/*$('.password_message').html(data3);*/
		},'html');	
	}
	);	
	
	
//验证码验证
var ajax;
$('#get_check_number').bind
	('keyup',function()
	{
		if(ajax){ajax.abort();}
		var get_check_number=$(this);
		get_check_number.next('span').remove();
		get_check_number.after('<span class="get_check_number_message"></span>');
	var data4=$('#get_check_number').serialize();
	ajax=$.post('/login/ajax_log_in_get_check_number.php',data4,function(data4){
if(data4=='√'){$('#get_check_number').css("color","#0F0");}
if(data4=='×'){$('#get_check_number').css("color","#F00");}	
		/*$('.get_check_number_message').html(data4);*/
		},'html');	
	}
	);	

//提示文字
//account
$('#zhanghao').val('请输入昵称或者邮箱');
$('#zhanghao').css("color","#CCC");
$('#zhanghao').focus(function(){
	$(this).val()=='请输入昵称或者邮箱'? $(this).val(''): $(this);
	$('#zhanghao').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('昵称 邮箱地址').css("color","#CCC"): $(this);
});

//验证码提示
$('#get_check_number').val('请输入验证码');
$('#get_check_number').css("color","#CCC");
$('#get_check_number').focus(function(){
	$(this).val()=='请输入验证码'? $(this).val(''): $(this);
	$('#get_check_number').css("color","#000");
}).blur(function(){
   $(this).val()==''? $(this).val('请输入验证码').css("color","#CCC"): $(this);
});	

}

//实现登陆小绿点

$(".rowLogin").on('blur', 'input, textarea, select', function() {
	    $('.activeLogin').remove();
	});

	$(".rowLogin").on('focus', "input:not('.submit'), textarea, select", function() {
		if($('.activeLogin').length==0){
			$(this).parent().append('<span class="activeLogin"></span>');
		}
	    
	});
	</script>
    </div>
    </div>
 </div>
 <div class="login_three">
 </div>
 <?php
require_once("../repeat_code/footer.php")
?>
</body>
</html>
