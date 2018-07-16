#!/usr/bin/php
<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/function.php");//包含数据库连接文件
$query1="SELECT a.*,b.class1,b.id AS bid ".
"FROM tutorial AS a ".
"INNER JOIN tutorial_category1 AS b ON(a.category=b.id) ".
"WHERE price='0' AND youku_id='0'";
$query2="SELECT a.*,b.class1,b.id AS bid ".
"FROM examination AS a ".
"INNER JOIN examination_category1 AS b ON(a.category=b.id) ".
"WHERE price='0' AND youku_id='0'";
$result1=mysqli_query($dbc,$query1)or die('查询视频出错');
$result2=mysqli_query($dbc,$query2)or die('查询视频出错');
if((mysqli_num_rows($result1)+mysqli_num_rows($result2))==0){echo '没有需要上传的视频******';exit;}
$arr=array();
while($row1=mysqli_fetch_array($result1)){$arr[]=$row1;}
while($row2=mysqli_fetch_array($result2)){$arr[]=$row2;}
header('Content-type: text/html; charset=utf8');
include("YoukuUploader.class.php");
foreach($arr as $row){
	//循环开始
	echo '正在上传的是';if(!isset($row['school'])){echo 'tutorial'.'******';$type='t';}else{echo 'examination'.'******';$type='x';};echo '视频id为：'.$row['id'].'******'.'视频标题为：'.$row['heading'].'******';
/*****YoukuUpload SDK*****/



$client_id = "7689d06ecd625c63"; // Youku OpenAPI client_id
$client_secret = "01cdc56891be27aa1a2616dbabd2f933"; //Youku OpenAPI client_secret

$params['access_token'] = "fffc74e6503c5e05a656073c3bde0853"; 
$params['refresh_token'] = "afe3fbc6ac9b62c6e3a62bd80af31143";
$params['username'] = ""; //Youku username or email
$params['password'] = md5(""); //Youku password

set_time_limit(0);
ini_set('memory_limit', '128M');
$youkuUploader = new YoukuUploader($client_id, $client_secret);
if(!isset($row['school'])){$file_name = "../tutorial/tutorials/$row[video]";} //video file
else{$file_name = "../examination/examinations/$row[video]";}
try {
    $file_md5 = @md5_file($file_name);
    if (!$file_md5) {
        throw new Exception("Could not open the file!\n");
    }
}catch (Exception $e) {
    echo "(File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
    return;
}
$file_size = filesize($file_name);
$tag=cut($row['class1'],11);
if(!isset($row['school'])){$url='tutorial/video_topics.php?category='.$row['bid'];}else{$url='examination/video_topics.php?category='.$row['bid'];};
$uploadInfo = array(
       /* "public_type" => "password",
		"watch_password" => "gephenom",*/
		"title" => "$row[heading]", //video title
		"tags" => "$tag 视频教程 视屏教程 教程 聚峰网", //tags, split by space
		"description" => "$row[heading] 由聚峰网用户精心上传，聚峰网致力于打造中国最好的视频教程分享网站，更多精彩的教程请访问聚峰网 —— www.gephenom.com/$url",
		"file_name" => $file_name, //video file name
		"file_md5" => $file_md5, //video file's md5sum
		"file_size" => $file_size //video file size
);
$progress = true; //if true,show the uploading progress 
$youkuUploader->upload($progress, $params,$uploadInfo); 
$myfile = 'youku_id.txt';
$str = "".$type."|".$_SESSION['youku_id']."|".$row['id']."*";
$file_pointer = fopen($myfile,"a");
fwrite($file_pointer,$str);
fclose($file_pointer);
}//循环结束
?>
