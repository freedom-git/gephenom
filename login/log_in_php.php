<?php 
header("Content-Type:text/html;charset=utf-8");
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/changliang.php");//包含常量文件
?>
<?php
//获取表单数据
$zhanghao=mysqli_real_escape_string($dbc,trim($_POST['zhanghao']));
$mima=mysqli_real_escape_string($dbc,trim($_POST['password']));
$get_check_number=mysqli_real_escape_string($dbc,trim($_POST['get_check_number']));
?>
<?php
//验证是电话邮箱还是昵称
if (preg_match('/^\d{11}$/',$_POST['zhanghao'])){$way = 'phone_number';}
if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/',$_POST['zhanghao'])){
//unix上可用，用来验证邮箱
/*$domain=preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/','',$email);	if(checkdnsrr($domain)){*/$way='email';/*}*/
}
if(!($way=='phone_number')&&!($way=='email')){$way='nickname';}
?>
<?php
//设置标记
$mark=1;

//表单验证
if(empty($zhanghao)){$mark=0;echo '<script type="text/javascript">
history.go(-1);
alert("请输入账号");
</script>';}
if(empty($mima)){$mark=0;echo '<script type="text/javascript">
history.go(-1);
alert("请输入密码");
</script>';}
if(empty($get_check_number)){$mark=0;echo '<script type="text/javascript">
history.go(-1);
alert("请输入验证码");
</script>';}




if($mark==1){
$mark0=1;

$query="SELECT * FROM user WHERE $way='$zhanghao'";
$result=mysqli_query($dbc,$query) or die ('查询数据库出错');
$query0="SELECT * FROM $yonghuzhucebiao WHERE $way='$zhanghao' and password=sha1('$mima')";
$result0=mysqli_query($dbc,$query0) or die ('查询密码出错');

//返回查询结果
if(!$row=mysqli_fetch_array($result)){$mark0=0;echo '<script type="text/javascript">
history.go(-1);
alert("您所登录的账号不存在，请点击注册");
</script>';}
if(mysqli_num_rows($result)>1){$mark0=0;echo '<script type="text/javascript">
history.go(-1);
alert("有多余查询结果，点击这里解决");
</script>';}
if(!$row=mysqli_fetch_array($result0)){$mark0=0;echo '<script type="text/javascript">
history.go(-1);
alert("密码错误，如果您忘记了密码。请点击找回密码");
</script>';}
if(!($_SESSION['session_pass_phrase']==sha1($get_check_number))){$mark0=0;echo '<script type="text/javascript">
history.go(-1);
alert("验证码错误");
</script>';}

	
//登录，注册会话变量
if($mark0==1){
	$_SESSION['session_nickname']=$row['nickname'];
	$_SESSION['session_user_id']=$row['id'];
	$_SESSION['session_money']=$row['money'];
	unset($_SESSION['zhanghao']);
	unset($_SESSION['session_pass_phrase']);
	unset($_SESSION['way']);
	echo '<script type="text/javascript">
history.go(-2);
</script>';
	}
}

mysqli_close($dbc);//关闭数据库
?>