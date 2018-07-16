
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
        <a href="#"><img id="img" title="看不清，换一张" src="../repeat_code/captcha.php" onclick="this.src = this.src + '?' + new Date().getTime();"  /></a>
       </div>
    </div>
    <div class="loginSubmit">
    <div class="login_a">
    <a href="../login/forgot_password.php">忘记密码</a>
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
		$('.zhanghao_message').html(data3);
		},'html');	
	}
	);

//密码验证	
$('#password').bind
	('blur',function()
	{
		var password=$(this);
		password.next('span').remove();
		password.after('<span class="password_message"></span>');
	var data3=$('#password').serialize();
	$.post('/login/ajax_log_in_password.php',data3,function(data3){
		$('.password_message').html(data3);
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
		$('.get_check_number_message').html(data4);
		},'html');	
	}
	);	

//提示文字
//account
$('#zhanghao').val('昵称  手机号码  邮箱地址');
$('#zhanghao').css("color","#CCC");
$('#zhanghao').focus(function(){
	$(this).val()=='昵称  手机号码  邮箱地址'? $(this).val(''): $(this);
	$('#zhanghao').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('昵称  手机号码  邮箱地址').css("color","#CCC"): $(this);
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