<?php
require("../../phpmailer/class.phpmailer.php");//包含email发送文
require_once("../../repeat_code/session_start.php");//包含会话开始文件	
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../repeat_code/manage_head.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现邮件</title>
</head>
<?php	
if(isset($_POST['tongguo'])||isset($_POST['jujue'])){$id=$_POST['id'];
$query0="SELECT * FROM tixian WHERE id='$id' AND pass=0 LIMIT 1";
$result0=mysqli_query($dbc,$query0)or die('查询出错');
$shifoushanchu=mysqli_num_rows($result0);
$row0=mysqli_fetch_array($result0);
if($shifoushanchu==0){echo '请求已经被删除';exit;}
$query="SELECT * FROM user WHERE id='$row0[user_id]' LIMIT 1";
$result=mysqli_query($dbc,$query)or die('查询出错');
$row=mysqli_fetch_array($result);
$address =$row['email'];
}else{exit;}
if(isset($_POST['tongguo'])){
	if($row['money']<$row0['money']){echo '余额不足';exit;}
	$query1="UPDATE tixian SET pass=$_SESSION[manager_id] WHERE id='$id' LIMIT 1";
    $result1=mysqli_query($dbc,$query1)or die('查询出错');
	$balance=$row['money']-$row0['money'];
	$query3="UPDATE user SET money='$balance' WHERE id='$row0[user_id]' LIMIT 1";
    $result3=mysqli_query($dbc,$query3)or die('查询出错');
	$query2="INSERT INTO trade (user_id,how_much,trade_no,balance,type) VALUES ('$row0[user_id]','$row0[money]','$row0[haoma]','$balance','2')";
    $result2=mysqli_query($dbc,$query2)or die('查询出错');
	$body="您的提现请求已经通过，".$row0['money']."元已经从聚峰网划往您的账户”".$row0['haoma']."“中。将在两天之内到帐";
	}
if(isset($_POST['jujue'])){
	$yuanyin=$_POST['yuanyin'];
	$query1="UPDATE tixian SET pass='-1' WHERE id='$id' LIMIT 1";
    $result1=mysqli_query($dbc,$query1)or die('查询出错');
	$body="您的提现请求没有通过，原因是”".$yuanyin."“,审核员编号为".$_SESSION['manager_id'].",如有疑问请通过页尾意见反馈反馈您的意见。";
	}
//用来发送邮箱验证邮件
$mail = new PHPMailer(); //建立邮件发送类
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
$mail->Subject ='聚峰网提现反馈';   //邮件标题
$mail->Body ="$body"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$account_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
$account_message= "邮件发送失败";echo $account_message;
}else{
	if(isset($_POST['tongguo'])){
	?>
<p>支付方式：<?php if($row0['type']==1){echo '支付宝';}if($row0['type']==2){echo '银行卡';}?></p>
<?php if($row0['type']==2){echo '<p>银行:'.$row0['dianyin'].'</p>';}?>
<p><?php if($row0['type']==1){echo '支付宝账号：'.$row0['haoma'];}if($row0['type']==2){echo '银行卡号：'.$row0['haoma'];}?></p>
<P>姓名：<?php echo $row0['name']?></P>
<p>金额：<?php echo $row0['money']?></p>
<?php if($row0['type']==1&&!empty($row0['dianyin'])){echo '<p>短信通知手机号码:'.$row0['dianyin'].'</p>';}?>
	<?php }else{echo '已经拒绝请求';}}

?>