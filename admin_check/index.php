<?php 
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据可连接文件
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理登录</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<SCRIPT type=text/javascript src="../java/jquery-1.9.1.min.js"></SCRIPT>
</head>
<body>
<div id="frame">
<?php
//获取表单数据
$zhanghao=mysqli_real_escape_string($dbc,trim($_POST['zhanghao']));
$mima=mysqli_real_escape_string($dbc,trim($_POST['password']));
$get_check_number=mysqli_real_escape_string($dbc,trim($_POST['get_check_number']));
		
//设置标记
$mark=1;

//表单验证
if(empty($get_check_number)&&isset($_POST['submit'])){$mark=0;echo '<script type="text/javascript">
alert("请输入验证码");
</script>';}
if(empty($mima)&&isset($_POST['submit'])){$mark=0;echo '<script type="text/javascript">
alert("请输入密码");
</script>';}
if(empty($zhanghao)&&isset($_POST['submit'])){$mark=0;echo '<script type="text/javascript">
alert("请输入账号");
</script>';}

if(!isset($_POST['submit'])){$mark=0;$error='';}

if($mark==1){
$mark0=1;

$query="SELECT * FROM manager WHERE name='$zhanghao' LIMIT 1";
$result=mysqli_query($dbc,$query) or die ('查询数据库出错');
$query0="SELECT * FROM manager WHERE name='$zhanghao' and password=sha1('$mima') LIMIT 1";
$result0=mysqli_query($dbc,$query0) or die ('查询密码出错');

//返回查询结果
if(!$row=mysqli_fetch_array($result0)){$mark0=0;echo '<script type="text/javascript">
alert("密码错误");
</script>';}
if(!($_SESSION['session_pass_phrase']==sha1($get_check_number))){$mark0=0;echo '<script type="text/javascript">
alert("验证码错误");
</script>';}
if(!$row=mysqli_fetch_array($result)){$mark0=0;echo '<script type="text/javascript">
alert("账号不存在");
</script>';}
	
//登录，注册会话变量
if($mark0==1){
	$_SESSION['manager_id']=$row['id'];
	$_SESSION['manager_name']=$row['name'];
	$_SESSION['manager_authority']=$row['authority'];
	unset($_SESSION['session_pass_phrase']);
	if($row['authority']==1){
		echo '<script type="text/javascript">
alert("欢迎来到网站后台");location.href="/admin_check/initiator.php";
</script>';}
	echo '<script type="text/javascript">
alert("登陆成功");
</script>';
	}
}

mysqli_close($dbc);//关闭数据库
?>

<div id="page">
<div class="dc1"><div class="d_11">
<h1 class="denglu">登录</h1>
<form class="form1" method="post" action="<?php echo $_server['php_self'];?>">

<div class="zhanghao">
  <label class="la" for="zhanghao">姓名:</label>
<input class="text" type="text" id="zhanghao" name="zhanghao" value="<?php echo $zhanghao;?>" />
</div>

<div class="mima">
<label class="la" for="password">密码:</label>
<input class="text" type="password" id="password" name="password" />

</div>
<div class="check_number">
<label for="get_check_number">验证码:</label>
<input class="text" type="text" id="get_check_number" name="get_check_number" />
<a href="#"><img id="img" title="看不清，换一张" src="../repeat_code/captcha.php" onClick="this.src = this.src + '?' + new Date().getTime();"  /></a></div>
<input class="submit" type="submit" value="登录" name="submit" id="submit" />
</form></div>
</div>
</div>


</div>
</body>
</html>
