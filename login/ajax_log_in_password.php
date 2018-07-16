<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
	
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
$mima=mysqli_real_escape_string($dbc,trim($_POST['password']));
$zhanghao=$_SESSION['log_in_zhanghao'];
$way=$_SESSION['log_in_way'];
$query="SELECT * FROM user WHERE $way='$zhanghao' and password=sha1('$mima')";
$result=mysqli_query($dbc,$query) or die ('查询密码出错');
if(!$row=mysqli_fetch_array($result)){echo '×';}else{echo'√';}
mysqli_close($dbc);//关闭数据库




	}
else{echo '该页面不允许直接浏览';}
?>