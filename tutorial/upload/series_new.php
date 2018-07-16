<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{

require_once("../../repeat_code/session_start.php");//会话
require_once("../../repeat_code/mysqli_connect.php");//数据库
require_once("../../repeat_code/function.php");

$series_text=mysqli_real_escape_string($dbc,trim($_POST['series_new']));
$query="SELECT * FROM tutorial_series WHERE user_id='$_SESSION[session_user_id]' AND series_name='$series_text'";
$result=mysqli_query($dbc,$query)or die('查询出错');
if (mysqli_fetch_array($result)){$series_check=该专辑已存在;}
else{
	if(!empty($series_text))
	$series_check=可用;
	}
if(strlen_utf8($series_text)>30){$series_check=专辑不能超过30个汉字或字符;}

if(empty($series_text)){$series_check=请输入专辑名称;}

echo $series_check;





	}
else{echo '该页面不允许直接浏览';}

?>