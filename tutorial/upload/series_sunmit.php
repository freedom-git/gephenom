<?php


if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{

require_once("../../repeat_code/session_start.php");//会话
require_once("../../repeat_code/mysqli_connect.php");//数据库


$series_name=mysqli_real_escape_string($dbc,trim($_POST['series_new']));
$series_picture=mysqli_real_escape_string($dbc,trim($_POST['series_picture2']));
if(!empty($series_name)&&!empty($series_picture)){

$query="INSERT INTO tutorial_series (user_id,series_name,title_picture) VALUE ('$_SESSION[session_user_id]','$series_name','$series_picture')";
mysqli_query($dbc,$query) or die(数据库出现错误);

$query2="SELECT * FROM tutorial_series WHERE user_id='$_SESSION[session_user_id]'";
$result2=mysqli_query($dbc,$query2)or die('查询出错');
$query3="SELECT * FROM tutorial_series WHERE series_name='$series_name'";
$result3=mysqli_query($dbc,$query3)or die('查询出错');
$row3=mysqli_fetch_array($result3);

$a1='<select class="upload_select" id="series" name="series">';
		$a2='<option value="'.$row3['id'].'">'.$series_name.'</option>';
		
          $a2.='<option value="0">不上传至专辑</option>';
       
					while($row2=mysqli_fetch_array($result2)){
						if($row2['series_name']!=$series_name){
						$a2.="<option value=".$row2['id'].">".$row2['series_name']."</option>";
						}
						}
					
                   
        $a3='</select>';
		
		echo $a1.$a2.$a3;
}
else{
	echo "专辑名不能空";
}
		
		
		
		
	}
else{echo '该页面不允许直接浏览';}

?>