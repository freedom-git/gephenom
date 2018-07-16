<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require("../phpmailer/class.phpmailer.php");//包含email发送文
require_once("../repeat_code/session_start.php");//包含会话开始文件	
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件	

$query="SELECT * FROM user WHERE id='$_SESSION[session_user_id]' LIMIT 1";
$result=mysqli_query($dbc,$query)or die('查询出错');
$row=mysqli_fetch_array($result);
if($_SESSION['email_check']=='checked'){$account_message= "您已经请求过一次验证码，请直接查询邮箱。";}
//用来发送邮箱验证邮件
	if($_SESSION['email_check']!='checked'){
$_SESSION['check_number']=rand(10000,99999);
$mail = new PHPMailer(); //建立邮件发送类
$address =$row['email'];
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
$mail->Subject ='聚峰网提现';   //邮件标题
$mail->Body ="尊敬的用户您好，欢迎您使用聚峰网提现功能，您的提现验证码为:".$_SESSION['check_number'].".感谢您对我们的支持，我们会竭诚为您服务。如果不是您本人操作，您的密码可能已经泄露，请立刻更改密码。"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$account_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
$account_message= "邮件发送失败";
}else{$account_message= "验证码已经发送到您的邮箱中，请登录邮箱查询。如果找不到邮件请在垃圾箱中寻找。";$_SESSION['email_check']='checked';}
}
echo"$account_message";

}
else{echo '该页面不允许直接浏览';}
?>