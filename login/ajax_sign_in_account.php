<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
	
$mark=1;
require("../phpmailer/class.phpmailer.php");//包含email发送文
require_once("../repeat_code/session_start.php");//包含会话开始文件	
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件	
//获取表单数据
//判断账号是手机号还是邮箱号
if (preg_match('/^\d{11}$/',$_POST['account'])){$phone_number = mysqli_real_escape_string($dbc,trim($_POST['account']));}
if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/',$_POST['account'])){
//unix上可用，用来验证邮箱
/*$domain=preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/','',$email);	if(checkdnsrr($domain)){*/$email=mysqli_real_escape_string($dbc,trim($_POST['account']));/*}*/
}
if((!isset($phone_number))&&(!isset($email))){$mark=0;$account_message=请输入正确的手机号码或邮箱地址;}
//如果是邮箱
if(isset($email)){//如果是邮箱开始

//检查是否获得验证码后更改账号
if(!($_SESSION['session_email']==$email)){$_SESSION['session_email']=$email;unset($_SESSION['sign_in_email_check']);}


//确定邮箱地址不重复注册
$query="select * from user where email='$email'";
$result=mysqli_query($dbc,$query)or die('查询邮箱地址号码出错');
if (mysqli_fetch_array($result)){$mark=0;$account_message='该邮箱地址已被注册，如果您忘记了密码，请到登录页面点击找回密码';}



if($_SESSION['sign_in_email_check']=='checked'){$account_message= "您已经请求过一次验证码，请直接查询邮箱。";}
//用来发送邮箱验证邮件
	if($mark==1&&(!$_SESSION['sign_in_email_check']=='checked')){
$_SESSION['$send_email_check_number']=rand(10000,99999);
$mail = new PHPMailer(); //建立邮件发送类
$address =$email;
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
$mail->Subject ='聚峰网注册';   //邮件标题
$mail->Body ="尊敬的用户您好，欢迎您加入聚峰网，您的验证码为:".$_SESSION['$send_email_check_number'].".感谢您对我们的支持，我们会竭诚为您服务。"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$account_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
$account_message= "邮件发送失败，请核对您的邮箱地址是否正确";
}else{$account_message= "验证码已经发送到您的邮箱中，请登录邮箱查询。如果找不到邮件请在垃圾箱中寻找。";$_SESSION['sign_in_email_check']='checked';}
}}










echo"$account_message";
}
else{echo '该页面不允许直接浏览';}
?>