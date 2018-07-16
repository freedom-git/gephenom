#!/usr/bin/php
<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
$file = 'youku_id.txt'; 
$content = file_get_contents($file); 
//echo $content; 

$array = explode("*", $content); 
//print_r($array); 

for($i=0; $i<count($array)-1; $i++) 
{ 
$array1 = explode("|", $array[$i]); 
$type=$array1[0];
$youku_id=$array1[1];
$id=$array1[2];
			if($type=='t'){
			$query3="UPDATE tutorial SET youku_id = '$youku_id' WHERE id=$id LIMIT 1";
$result3=mysqli_query($dbc,$query3)or die('error');echo '成功写入***';
			}
			if($type=='x')
			{
				$query3="UPDATE examination SET youku_id = '$youku_id' WHERE id=$id LIMIT 1";
$result3=mysqli_query($dbc,$query3)or die('error');echo '成功写入***';}
}//结束循环



$txt = '';
if(file_put_contents($file, $txt) !== FALSE)
{
    echo "清空txt成功!\n";
}
else
{
    echo "清空txt失败!\n";
}


  

				?>

