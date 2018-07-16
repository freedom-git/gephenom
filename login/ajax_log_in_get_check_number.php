<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
	
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
$get_check_number=mysqli_real_escape_string($dbc,trim($_POST['get_check_number']));
if(!($_SESSION['session_pass_phrase']==sha1($get_check_number))){echo '×';}else{echo'√';}







	}
else{echo '该页面不允许直接浏览';}
?>