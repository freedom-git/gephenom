<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
require_once("../repeat_code/function.php");//
require_once("../repeat_code/session_start.php");//会话

$zhanghao=mysqli_real_escape_string($dbc,trim($_POST['zhanghao']));
$_SESSION['log_in_zhanghao']=$zhanghao;
check_account($zhanghao);
$_SESSION['log_in_way']=$way;
}
else{echo '该页面不允许直接浏览';}
?>