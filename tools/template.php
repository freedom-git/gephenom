<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require_once("../repeat_code/function.php");//
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库









	}
else{echo '该页面不允许直接浏览';}
?>