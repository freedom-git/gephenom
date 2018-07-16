<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
	
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
$email_check_number=mysqli_real_escape_string($dbc,trim($_POST['email_check_number']));
//检查验证码
if(empty($email_check_number)){$check_number_message='f';}else{
	
     if(!($_SESSION['$send_email_check_number']==       $email_check_number)){$check_number_message='f';}else{$check_number_message='t';}
	 
	 
	 }







echo"$check_number_message";
	}
else{echo '该页面不允许直接浏览';}
?>