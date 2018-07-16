<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
require("../phpmailer/class.phpmailer.php");//包含email发送文	
require_once("../repeat_code/function.php");//
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库


//获取表单数据
$zhanghao=mysqli_real_escape_string($dbc,trim($_POST['zhanghao']));


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
if (!mysqli_fetch_array($result)){$account_message='此账号还不存在，请进入注册页面注册。';}


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
}else{$account_message= "验证码已经发送到您的邮箱中，请登录邮箱查询。如果找不到邮件请在垃圾箱中寻找。";
$_SESSION['forgot_password_email_check']='checked';}

}//邮箱发送完毕
else{
	
	$account_message='您已经请求过一次验证码，请直接查询邮箱。';}
}}

echo $account_message;





	}
else{echo '该页面不允许直接浏览';}
?>