<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require_once("../repeat_code/function.php");//
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库

$query="SELECT * FROM user WHERE id='$_SESSION[session_user_id]' LIMIT 1";
$result=mysqli_query($dbc,$query) or die('数据库连接失败');
$row=mysqli_fetch_array($result);
if($row){
	echo '您已经绑定账号：'.$row['email'];
	}
else{
	?>
    <form action="<?php echo $_SERVER['php_self']?>" method="post">
    邮箱地址：
    <input type="text" />
    <input value="获取邮箱验证码" type="submit" />
    <input value="获取手机验证码" type="submit" />
    邮箱验证码：
    <input type="text" />
    手机验证码：
    <input type="text" />
    <input value="确定" type="submit" />
    <?php
	}








	}
else{echo '该页面不允许直接浏览';}
?>