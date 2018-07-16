<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
	require_once("../../repeat_code/session_start.php");//会话
	require_once("../../repeat_code/mysqli_connect.php");//数据库
	require_once("../../repeat_code/function.php");
//处理程序
	$series_name=mysqli_real_escape_string($dbc,trim($_POST['series_name']));
	$query="SELECT * FROM examination_series WHERE user_id='$_SESSION[session_user_id]' AND series_name='$series_name'";
	$result=mysqli_query($dbc,$query)or die('查询出错');
	if(mysqli_fetch_array($result)){$series_check=该专辑已存在;
	}else{
		if(!empty($series_name))
		$series_check=可用;
		}
	if(strlen_utf8($series_name)>30){$series_check=专辑不能超过30个汉字或字符;}
	if(empty($series_name)){$series_check=请输入专辑名称;}
	echo $series_check;
}else{
	echo '该页面不允许直接浏览';
	}
?>