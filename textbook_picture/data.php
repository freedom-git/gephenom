<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/function.php");
if(isset($_SESSION['data_mark'])){//可执行开始
$data_mark=$_SESSION['data_mark'];
if(isset($_GET['free'])){$free = mysqli_real_escape_string($dbc,trim($_GET['free']));}
if(isset($_GET['search'])){$serch_text=mysqli_real_escape_string($dbc,trim($_GET['search']));}//搜索
if(isset($_GET['type']))
{$type=mysqli_real_escape_string($dbc,trim($_GET['type']));}else{exit;}
if(isset($_GET['new']))
{$new=mysqli_real_escape_string($dbc,trim($_GET['new']));}else{exit;}
if(isset($_GET['category']))
{$category=mysqli_real_escape_string($dbc,trim($_GET['category']));}
$search_query="select * ".
"from textbook_picture ";
if(!empty($serch_text)){
$search_query.=deal($serch_text,"textbook_information","AND","WHERE");
}
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');

$i=0;
while($row=mysqli_fetch_array($result)) {if($row['id']==11){$i++;continue;};$i++;
$arr=explode("*",$row['textbook_information']);
?>
      <div class="show_content">
<a target="_blank" href="/<?php if($type=='x'){echo 'examination';}
	  if($type=='s'){echo 'key';}
	  if((!$type=='x')&&(!$type=='s')){exit;}?>/upload/upload_two.php?id=<?php echo $row['id']?>&new=<?php echo $new;if(isset($category)){echo '&category='.$category;}?>&free=<?php echo $free?>" ><img src="/textbook_picture/<?php echo $row['picture']?>" alt="呀！木有图！" width="180" height="227" /></a>
         
         <div class="content_infor">
               <p class="content_mingzi"><a href="/<?php if($type=='x'){echo 'examination';}
	  if($type=='s'){echo 'key';}
	  if((!$type=='x')&&(!$type=='s')){exit;}?>/upload/upload_two.php?id=<?php echo $row['id']?>&new=<?php echo $new;if(isset($category)){echo '&category='.$category;}?>&free=<?php echo $free?>"><?php echo '书名：'.$arr[0].'<br />'.'作者：'.$arr[1].'<br />'.'出版社：'.$arr[2] ;?></a></p>
          </div>
</div><?php }
$_SESSION['data_mark']=$_SESSION['data_mark']+12;
if($i!=12){unset($_SESSION['data_mark']);}
//可执行结束
}else{}
?>