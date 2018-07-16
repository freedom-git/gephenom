<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
require_once("repeat_code/session_start.php");//包含会话开始文件
require_once("repeat_code/changliang.php");//包含常量文件
require("phpmailer/class.phpmailer.php");//包含email发送文
require_once("repeat_code/mysqli_connect.php");//包含数据库连接文件
?>
<?php
$address='401048056@qq.com';
$_SESSION['$send_email_check_number']=rand(10000,99999);
$mail = new PHPMailer(); //建立邮件发送类
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->CharSet='utf-8';// 设置邮件的字符编码
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = '18204319640@163.com'; // 邮局用户名(请填写完整的email地址)
$mail->Password = "ZhangZhi220807"; // 邮局密码
$mail->From = "18204319640@163.com"; //邮件发送者email地址
$mail->FromName = '大神之路';
$mail->AddAddress("$address","$nickname");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject ='大神之路注册';  //邮件标题
$mail->Body ="你好，".$nickname."欢迎您加入大神之路，您的验证码为:".$_SESSION['$send_email_check_number'].".感谢您对我们的支持，我们会竭诚为您服务。"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$email_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
echo '<script type="text/javascript">
alert("邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo);
</script>';
}else{$ok= "邮件发送成功";$_SESSION['sign_in_email_check']='checked';}
echo $ok;
?>
</body>
</html>