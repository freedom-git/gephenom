<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
	
	
	
	
require_once("../repeat_code/session_start.php");//包含会话开始文件	
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
$nickname=mysqli_real_escape_string($dbc,trim($_POST['nickname']));
//确定昵称不重复注册
$query="select * from user where nickname='$nickname'";
$result=mysqli_query($dbc,$query)or die('查询昵称出错');
if (mysqli_fetch_array($result)){$nickname_check='(⊙o⊙)';}
//昵称可用验证
else{
	if(!empty($nickname))
	$nickname_check='(^ω^)';
	}
if(strlen($nickname)>15){$nickname_check='(⊙o⊙)';}

if(empty($nickname)){$nickname_check='(⊙o⊙)';}
//昵称验证结束

echo $nickname_check;
?>
<?php
	
	
	}
else{echo '该页面不允许直接浏览';}
?>