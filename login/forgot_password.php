<?php
require_once("../repeat_code/changliang.php");//包含常量文件
require("../phpmailer/class.phpmailer.php");//包含email发送文件
require_once("../repeat_code/head.php");//获取头文件
?>
<title>找回密码</title>
<link href="forgot_password.css" rel="stylesheet" type="text/css" />
</head>

<?php 
if(!isset($_POST['send_forgot_password_check_number'])&&!isset($_POST['submit'])){}else{//点过了按钮
	if(isset($_POST['send_forgot_password_check_number'])||isset($_POST['submit']))
	{//点过了发送按钮


//获取表单数据
$zhanghao=mysqli_real_escape_string($dbc,trim($_POST['zhanghao']));		
$get_forgot_password_check_number=mysqli_real_escape_string($dbc,trim($_POST['get_forgot_password_check_number']));
$new_password=mysqli_real_escape_string($dbc,trim($_POST['new_password']));
$repeat_new_password=$_POST['repeat_new_password'];

		
//验证是电话邮箱还是昵称
if (preg_match('/^\d{11}$/',$_POST['zhanghao'])){$way = 'phone_number';}
if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/',$_POST['zhanghao'])){
//unix上可用，用来验证邮箱
/*$domain=preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/','',$email);	if(checkdnsrr($domain)){*/$way='email';/*}*/
}
if(!($way=='phone_number')&&!($way=='email')){$way='nickname';}


//防止获得验证码后更改账户名
if(!($_SESSION['forgot_password_zhanghao']==$zhanghao)){$_SESSION['forgot_password_zhanghao']=$zhanghao;unset($_SESSION['forgot_password_email_check']);}

//设立标记
$mark=1;

//验证表单
//查询账号是否存在
if($mark==1){
$query="SELECT * FROM user WHERE $way='$zhanghao'";
$result=mysqli_query($dbc,$query) or die (查询数据库出错);
if (!mysqli_fetch_array($result)){echo '<script type="text/javascript">
alert("此账号还不存在，请进入注册页面注册");
window.location.href="/login/sign_in.php";
</script>';}


//else，如果账号存在
else{
	
	if(!$_SESSION['forgot_password_email_check']=='checked'&&$way==email){//用来发送邮箱验证邮件
	
	$_SESSION['forgot_password_send_email_check_number']=rand(10000,99999);
	$mail = new PHPMailer(); //建立邮件发送类
	$address =$zhanghao;
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->CharSet='utf-8';// 设置邮件的字符编码
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = 'gephenom@163.com'; // 邮局用户名(请填写完整的email地址)
$mail->Password = "ZhangZhi220807"; // 邮局密码
$mail->From = "gephenom@163.com"; //邮件发送者email地址
$mail->FromName = '聚峰网';
$mail->AddAddress("$address", "尊敬的用户");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject ='聚峰网找回密码';   //邮件标题
$mail->Body ="尊敬的用户您好,您找回密码的验证码为:".$_SESSION['forgot_password_send_email_check_number'].".感谢您对我们的支持，我们会竭诚为您服务。"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$account_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
$account_message= "邮件发送失败，请核对您的邮箱地址是否正确";
}else{$account_message= "验证码已经发送到您的邮箱中，请登录邮箱查询。";
	$_SESSION['forgot_password_email_check']='checked';}

}//邮箱发送完毕
//else{$ok='邮件已经发送过了，不能重复发送';}

if(isset($_POST['submit']))
{//如果注册以点击
if ($new_password!=$repeat_new_password){$mark=0;echo '<script type="text/javascript">
alert("两次输入的密码不同，请重新输入");
</script>';}

if (!preg_match('/^\w{6,20}$/',$new_password)&&!empty($new_password)){$mark=0;echo '<script type="text/javascript">
alert("密码为6到20个字母或数字组成（区分大小写）");
</script>';}

if(empty($new_password)){$mark=0;echo '<script type="text/javascript">
alert("请输入密码");
</script>';}

if(!($_SESSION['forgot_password_send_email_check_number']==$get_forgot_password_check_number)){$mark=0;echo '<script type="text/javascript">
alert("验证码错误");
</script>';}

if(empty($get_forgot_password_check_number)){$mark=0;echo '<script type="text/javascript">
alert("请输入验证码");
</script>';}

if($mark==1&&$_SESSION['forgot_password_email_check']='checked'){//执行更换密码
$query0="UPDATE user SET password = sha1('$new_password') WHERE $way='$zhanghao' LIMIT 1 ;";
$result0=mysqli_query($dbc,$query0) or die (改变密码失败);
//发送更改成功邮件
if($way=='email'){//发送邮件通知
$mail = new PHPMailer(); //建立邮件发送类
$address =$zhanghao;
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->CharSet='utf-8';// 设置邮件的字符编码
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = 'gephenom@163.com'; // 邮局用户名(请填写完整的email地址)
$mail->Password = "ZhangZhi220807"; // 邮局密码
$mail->From = "gephenom@163.com"; //邮件发送者email地址
$mail->FromName = '聚峰网';
$mail->AddAddress("$address", "尊敬的用户");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject = "密码更改提示"; //邮件标题
$mail->Body = "您好，感谢您对聚峰网的支持，您的密码已经更改成功。"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
echo '<script type="text/javascript">
alert("邮件发送失败");
</script>';/*$ok= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;
exit;*/
}
$ok= "邮件发送成功";
//邮件发送完毕

//删除过程会话
unset($_SESSION['way']);
unset($_SESSION['zhanghao']);
unset($_SESSION['forgot_password_email_check']);
unset($_SESSION['send_email_check_number']);}//邮件通知完毕
echo '<script type="text/javascript">
history.go(-2);
alert("更改密码成功");
</script>';
	}//执行更换密码结束
	}//如果已点击注册结束
}//else,如果账号存在，结束

}
}//点过了发送按钮结束
}//点过了按钮结束
?>

<body>
<div id="frame">
<?php
require_once("../repeat_code/nav.php");//包含导航栏头文件
?>
<div id="page">
   <div class="information">
      <p id="jieshao">只为提供最优质 最全面的服务 欢迎加入我们</p>
      <?php echo $ok;?>
   </div>
<form method="post" action="<?php echo $_server['php_self'];?>">
 <div class="forgot_container">

       <div class="forgot_main">
         <div class="forgot_row_text_left forgot_text">
             <div class="forgot_text_left_a forgot_row" >
               <p id="biaoQian">账号*</p>
               <input type="text" id="zhanghao" class="forgot_input_text" name="zhanghao" value="<?php echo $zhanghao;?>" />
             </div>
             <div class="forgot_text_left_b">
                
                <div class="forgot_text_left_b_a forgot_row">
                  <p id="biaoQian">新密码*</p>
                 <input type="password" id="new_password" class="forgot_input_text" name="new_password" />
                </div>
             </div>
             
         </div>
         <div class="forgot_row_text_right forgot_text">
             <div class="forgot_text_right_a forgot_row">
                 <p id="biaoQian">验证码*</p>
                   <input type="text" id="get_forgot_password_check_number" class="forgot_input_text_check" name="get_forgot_password_check_number" value="<?php echo $get_forgot_password_check_number;?>" />
                </div>
                <div class="forgot_text_left_b_b">
                     <input type="button" id="send_forgot_password_check_number" class="forgot_input_submit" name="send_forgot_password_check_number" value="获取验证码" />
                 
             </div>
             <div class="forgot_text_right_b forgot_row">
                 <p id="biaoQian">重复新密码*</p>
                 <input type="password" id="repeat_new_password" class="forgot_input_text" name="repeat_new_password" />
             </div>
         </div>
      <div class="forgot_row_submit">
            <input type="submit" id="submit" class="forgot_input_submit" name="submit" value="确定"/>
         </div>
       
       </div>
  </div>
</form>
 </div>


</div>
<?php 
require_once("../repeat_code/footer.php");
?>
</body>
</html>
<script type="text/javascript">
$(document).ready(dosomething1);
function dosomething1()
{

//账号验证
$('#zhanghao').bind
	('blur',function()
	{
		var zhanghao=$(this);
		zhanghao.next('span').remove();
		zhanghao.after('<span class="zhanghao_message0"></span>');
	var data4=$('#zhanghao').serialize();
	$.post('/login/ajax_forgot_password_account.php',data4,function(data4){
		if(data4=='√'){$('#zhanghao').css("color","#0F0");}
		if(data4=='×'){$('#zhanghao').css("color","#F00");}
		/*$('.zhanghao_message0').html(data4);*/
		},'html');	
	}
	);


//发送验证码	
$('#send_forgot_password_check_number').bind
	('click',function()
	{
		var account=$('#get_forgot_password_check_number');
		account.next('span').remove();
		account.after('<span class="account"></span>');
		$('#send_forgot_password_check_number').css("background-color","#8c8c8c");
		$("#send_forgot_password_check_number").attr("disabled", true);			
	var data=$('#zhanghao').serialize();
	$.post('ajax_forgot_password_send_check_number.php',data,function(data){
		/*$('.account').html(data)*/
		alert(data);
		if(data=='验证码已经发送到您的邮箱中，请登录邮箱查询。'){$('#zhanghao').css("color","#0F0");}else{{$('#zhanghao').css("color","#F00");}}
		if(data=='此账号还不存在，请进入注册页面注册。'){$('#zhanghao').css("color","#FF8040");}
		},'html');	
	}
	);
$('#zhanghao').keyup(function()
	{
		$("#send_forgot_password_check_number").removeAttr("disabled");
		$('#send_forgot_password_check_number').css("background-color","#22cacc");
		}
	)
	
//验证码验证
var ajax;
$('#get_forgot_password_check_number').bind
	('keyup',function()
	{
		if(ajax){ajax.abort();}
		var get_check_number=$(this);
		get_check_number.next('span').remove();
		get_check_number.after('<span class="get_check_number_message"></span>');
	var data4=$('#get_forgot_password_check_number').serialize();
	ajax=$.post('ajax_forgot_password_get_check_number.php',data4,function(data4){
		if(data4=='×'){$('#get_forgot_password_check_number').css("color","#F00");}
		if(data4=='√'){$('#get_forgot_password_check_number').css("color","#0F0");}
		/*$('.get_check_number_message').html(data4);*/
		},'html');	
	}
	);	


/*password*/
$("#submit").attr("disabled", true);
$('#new_password').focus(function(){$('#new_password').css("color","#000");});
$('#repeat_new_password').focus(function(){$('#repeat_new_password').css("color","#000");});
$('#new_password').bind('blur',function(){
	var new_password=$(this);
	new_password.next('span').remove();
	if($.trim(new_password.val())==''){
		$('#new_password').css("color","#F00");
		/*new_password.after('<span class="password">请输入密码</span>');*/		}else{
	var passwordpattern=/^\w{6,20}$/;
	if(!passwordpattern.test(new_password.val())){
		$('#new_password').css("color","#F00");
		/*new_password.after('<span class="password">密码为6到20个字母或数字组成（区分大小写）</span>');*/				}}
			if($.trim(new_password.val())!=''&&passwordpattern.test(new_password.val())){$('#new_password').css("color","#0F0");}
	})

$('#repeat_new_password').bind
	('keyup',function()
	{
		var repeat_new_password=$(this);
		repeat_new_password.next('span').remove();
		var password0=$('#new_password');
		if(!(password0.val()==repeat_new_password.val())){
			$('#repeat_new_password').css("color","#F00");
			/*repeat_new_password.after('<span class="repeat_new_password">两次输入的密码不同，请重新输入</span>');*/}
		else{
			var new_password=$('#new_password');
			$('#repeat_new_password').css("color","#0F0");
			/*new_password.next('span').remove();*/
			if($.trim(new_password.val())==''){
				$('#repeat_new_password').css("color","#F00");
		         /*new_password.after('<span class="password">请输入密码</span>');*/		}else{
	var passwordpattern=/^\w{6,20}$/;
	if(!passwordpattern.test(new_password.val())){
		$('#new_password').css("color","#F00");
		/*new_password.after('<span class="password">密码为6到20个字母或数字组成（区分大小写）</span>');*/		}else{$("#submit").removeAttr("disabled");}}
			}
			})
			
}

//提示文字
//account
$('#zhanghao').val('请输入您注册使用的手机号码或邮箱地址');
$('#zhanghao').css("color","#CCC");
$('#zhanghao').focus(function(){
	$(this).val()=='请输入您注册使用的手机号码或邮箱地址'? $(this).val(''): $(this);
	$('#zhanghao').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('请输入您注册使用的手机号码或邮箱地址').css("color","#CCC"): $(this);
});

//验证码提示
$('#get_forgot_password_check_number').val('请输入验证码');
$('#get_forgot_password_check_number').css("color","#CCC");
$('#get_forgot_password_check_number').focus(function(){
	$(this).val()=='请输入验证码'? $(this).val(''): $(this);
	$('#get_forgot_password_check_number').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('请输入验证码').css("color","#CCC"): $(this);
});


</script>