// JavaScript Document for login


// 实现注册框显隐
$(document).ready(function(){
	// 实现注册框小绿点
	$(".row").on('blur', 'input, textarea, select', function() {
	    $('.active').remove();
	});

	$(".row").on('focus', "input:not('.submit'), textarea, select", function() {
		if($('.active').length==0){
			$(this).parent().append('<span class="active"></span>');
		}
	    
	});
	
	
	
	
	
//提示文字
//nickname
$('#nickname').val('昵称不能超过十五个字符，五个汉字');
$('#nickname').css("color","#CCC");
$('#nickname').focus(function(){
	$(this).val()=='昵称不能超过十五个字符，五个汉字'? $(this).val(''): $(this);
	$('#nickname').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('昵称不能超过十五个字符，五个汉字').css("color","#CCC"): $(this);
});

//account
$('#account').val('请输入您的邮箱地址');
$('#account').css("color","#CCC");
$('#account').focus(function(){
	$(this).val()=='请输入您的邮箱地址'? $(this).val(''): $(this);
	$('#account').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('请输入您的邮箱地址').css("color","#CCC"): $(this);
});

//form_email_check
$('#email_check_number').val('请输入验证码');
$('#email_check_number').css("color","#CCC");
$('#email_check_number').focus(function(){
	$(this).val()=='请输入验证码'? $(this).val(''): $(this);
	$('#email_check_number').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('请输入验证码').css("color","#CCC"): $(this);
});





	
	
//翻页	
	






	
});