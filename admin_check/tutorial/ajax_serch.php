<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件

$_SESSION['serch_data_mark']=0;
$serch_data_mark=$_SESSION['serch_data_mark'];
$serch_text=$_POST['serch_text'];
$category=$_GET['category'];
$search_query="select * from upload";
$where_list=array();
$final_search_words=array();
$clean_search=str_replace('，',' ',$serch_text);
$clean_search=str_replace(',',' ',$clean_search);
$search_words = explode(' ',$clean_search);
if (count($search_words)>0){
	foreach($search_words as $word){
		if(!empty($word)){
			$final_search_words[]=$word;
			}
		}
	}
if(count($final_search_words)>0){
	foreach($final_search_words as $word){$where_list[]="video_heading LIKE '%$word%'";}}
$where_clause=implode(' OR ',$where_list);
if(!empty($where_clause)){
	$search_query.=" WHERE category='$category' AND $where_clause"." limit $serch_data_mark,12";
	}

$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
$i=0;
while($row=mysqli_fetch_array($result)) {$i++;?><div class="_11"><a href="display.php?url=<?php echo urlencode($row['video'])?>"><img src="../tutorials/<?php echo $row['upload_picture']?>" width="240" height="170" /></a>视屏名称：<?php echo $row['video_heading']?><br />￥<?php echo $row['wish_price']?><br />上传时间：<?php echo substr($row['date'],0,10);?></div><?php }


$_SESSION['serch_data_mark']=$_SESSION['serch_data_mark']+12;

if($i==0){$message='您搜索的视频还没有人上传，赶紧发动身边的大神们上传吧！';}else{$message='';}
echo $message;



?>
