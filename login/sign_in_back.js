// JavaScript Document
$(document).ready(dosomething);
function dosomething()
{

/*nickname*/	
$('#nickname').bind
	('blur',function()
	{
		var nickname=$('#nickname');
		nickname.next('span').remove();
		nickname.after('<span class="nickname"></span>');
		$("#form_nickname_check").attr("disabled", true);			
	var data0=$('#nickname').serialize();
	$.post('ajax_sign_in_nickname.php',data0,function(data0){
		/*$('.nickname').html(data0)*/
		/*var html=$('.nickname').text();*/
		if(data0=='(⊙o⊙)'){$('#nickname').css("color","#F00");}
		if(data0=='(^ω^)'){$('#nickname').css("color","#0f0");}
		},'html');	
	}
	);
$('#nickname').keyup(function()
	{
		$("#form_nickname_check").removeAttr("disabled");
		}
	)	

/*account*/
$('#form_email_check').bind
	('click',function()
	{
		var account=$('#account');
		account.next('span').remove();
		account.after('<span class="account"></span>');
		$('#form_email_check').css("background-color","#8c8c8c");
		$("#form_email_check").attr("disabled", true);
	var data1=$('#account').serialize();
	$.post('ajax_sign_in_account.php',data1,function(data1){
		/*$('.account').html(data1)*/
		alert(data1);
		if(data1=='验证码已经发送到您的邮箱中，请登录邮箱查询。'){$('#account').css("color","#0F0");}else{{$('#account').css("color","#F00");}}
		if(data1=='该邮箱地址已被注册，如果您忘记了密码，请到登录页面点击找回密码'){$('#account').css("color","#FF8040");}
		
		},'html');	
	}
	);
$('#account').keyup(function()
	{
		$("#form_email_check").removeAttr("disabled");
		$('#form_email_check').css("background-color","#22cacc");
		}
	)	


/*check_number*/
$('#email_check_number').bind
	('blur',function()
	{   
		var email_check_number=$('#email_check_number');
		email_check_number.next('span').remove();
		email_check_number.after('<span class="check_number"></span>');
		$("#check_number").attr("disabled", true);			
	var data2=$('#email_check_number').serialize();
	$.post('ajax_sign_in_verification_code.php',data2,function(data2){
		/*$('.check_number').html(data2)*/
		if(data2=='f'){$('#email_check_number').css("color","#F00");}
		if(data2=='t'){$('#email_check_number').css("color","#0F0");}
		},'html');	
	}
	);
$('#email_check_number').keyup(function()
	{
		$("#check_number").removeAttr("disabled");
		}
	)	


/*password*/
$('#password1').focus(function(){$('#password1').css("color","#000");});
$('#repeat').focus(function(){$('#repeat').css("color","#000");});
$('#password1').bind('blur',function(){
	var password1=$(this);
	password1.next('span').remove();
	if($.trim(password1.val())==''){
		$('#password1').css("color","#F00");
		/*password1.after('<span class="password">请输入密码</span>');*/		}else{
	var passwordpattern=/^\w{6,20}$/;
	if(!passwordpattern.test(password1.val())){
		$('#password1').css("color","#F00");
		/*password1.after('<span class="password">密码为6到20个字母或数字组成（区分大小写）</span>');*/				}}
			if($.trim(password1.val())!=''&&passwordpattern.test(password1.val())){$('#password1').css("color","#0F0");}
	})

$('#repeat').bind
	('keyup',function()
	{
		var repeat=$(this);
		repeat.next('span').remove();
		var password0=$('#password1');
		if(!(password0.val()==repeat.val())){
			$('#repeat').css("color","#F00");
			/*repeat.after('<span class="repeat">两次输入的密码不同，请重新输入</span>');*/}
		else{
			var password1=$('#password1');
			$('#repeat').css("color","#0F0");
			/*password1.next('span').remove();*/
			if($.trim(password1.val())==''){
				$('#repeat').css("color","#F00");
		         /*password1.after('<span class="password">请输入密码</span>');*/		}else{
	var passwordpattern=/^\w{6,20}$/;
	if(!passwordpattern.test(password1.val())){
		$('#password1').css("color","#F00");
		/*password1.after('<span class="password">密码为6到20个字母或数字组成（区分大小写）</span>');*/		}else{$("#sign_in_submit").removeAttr("disabled");}}
			}
			})
			

}