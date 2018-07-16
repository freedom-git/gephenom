<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require_once("../repeat_code/function.php");//
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
$get_forgot_password_check_number=mysqli_real_escape_string($dbc,trim($_POST['get_forgot_password_check_number']));
if(empty($get_forgot_password_check_number)){echo '×';}else{
if(!($_SESSION['forgot_password_send_email_check_number']==$get_forgot_password_check_number)){echo '×';}else{echo'√';}}







	}
else{echo '该页面不允许直接浏览';}
?>