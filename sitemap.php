<?php 
require_once("repeat_code/head.php");
?>
<?php
$query="SELECT a.class0,b.* ".
"FROM examination_category0 AS a ".
"INNER JOIN examination_category1 AS b ON(a.id=b.class0_id) ORDER BY class0_id ASC";
$result=mysqli_query($dbc,$query) or die('出错');
$arr= array();
while($row=mysqli_fetch_array($result)){$arr[] =$row;}
$row0=$arr; 
$i=0;
$i_0=0;
?>     
   
<?php
$i=0;
$i_0=0;
$xiang=array();
$xiao=array();
foreach($row0 as $row){
$i_0++;
if($class0==$row['class0']||$i_0==1){$xiang[]=$row['class1'];$xiao[]=$row['id'];}
if(!($class0==$row['class0'])||$i_0==count($row0)){$class0=$row['class0'];
if($i_0==1){continue;}
$i++;
?>

    <?php
	$zu=$xiang;
	$i_1=0;
	 foreach($zu as $zu){
$str.="http://www.gephenom.com/examination/video_topics.php?category=".$xiao[$i_1]."\r\n";
$i_1++;}?>

   
              
<?php 
unset($xiao);unset($xiang);$xiang[]=$row['class1'];$xiao[]=$row['id'];	}}
?> 
<?php
//如果最后一个大项只有一个小项
if(!empty($xiang)){
	?>
    <?php
	$zu=$xiang;
	$i_1=0;
	 foreach($zu as $zu){
$str.="http://www.gephenom.com/examination/video_topics.php?category=".$xiao[$i_1]."\r\n";
$i_1++;}?>

<?php	}
//如果最后一个大项只有一个小项
?>








<?php
$query="SELECT a.class0,b.* ".
"FROM tutorial_category0 AS a ".
"INNER JOIN tutorial_category1 AS b ON(a.id=b.class0_id) ORDER BY class0_id ASC";
$result=mysqli_query($dbc,$query) or die('出错');
$arr= array();
while($row=mysqli_fetch_array($result)){$arr[] =$row;}
$row0=$arr; 
$i=0;
$i_0=0;


?>     
   
<?php
$i=0;
$i_0=0;
$xiang=array();
$xiao=array();
foreach($row0 as $row){
$i_0++;
if($class0==$row['class0']||$i_0==1){$xiang[]=$row['class1'];$xiao[]=$row['id'];}
if(!($class0==$row['class0'])||$i_0==count($row0)){$class0=$row['class0'];
if($i_0==1){continue;}
$i++;
?>

    <?php
	$zu=$xiang;
	$i_1=0;
	foreach($zu as $zu){
$str.="http://www.gephenom.com/tutorial/video_topics.php?category=".$xiao[$i_1]."\r\n";
$i_1++;}?>

   
              
<?php 
unset($xiao);unset($xiang);$xiang[]=$row['class1'];$xiao[]=$row['id'];	}}
?> 
<?php
//如果最后一个大项只有一个小项
if(!empty($xiang)){
	?>
    <?php
	$zu=$xiang;
	$i_1=0;
foreach($zu as $zu){
$str.="http://www.gephenom.com/tutorial/video_topics.php?category=".$xiao[$i_1]."\r\n";
$i_1++;}?>

<?php	}
//如果最后一个大项只有一个小项
?>
        
        
        
        

<?php
$query="SELECT a.class0,b.* ".
"FROM solution_category0 AS a ".
"INNER JOIN solution_category1 AS b ON(a.id=b.class0_id) ORDER BY class0_id ASC";
$result=mysqli_query($dbc,$query) or die('出错');
$arr= array();
while($row=mysqli_fetch_array($result)){$arr[] =$row;}
$row0=$arr; 
$i=0;
$i_0=0;
?>     
   
<?php
$i=0;
$i_0=0;
$xiang=array();
$xiao=array();
foreach($row0 as $row){
$i_0++;
if($class0==$row['class0']||$i_0==1){$xiang[]=$row['class1'];$xiao[]=$row['id'];}
if(!($class0==$row['class0'])||$i_0==count($row0)){$class0=$row['class0'];
if($i_0==1){continue;}
$i++;
?>

    <?php
	$zu=$xiang;
	$i_1=0;
	foreach($zu as $zu){
$str.="http://www.gephenom.com/key/key3.php?category=".$xiao[$i_1]."\r\n";
$i_1++;}?>

   
              
<?php 
unset($xiao);unset($xiang);$xiang[]=$row['class1'];$xiao[]=$row['id'];	}}
?> 
<?php
//如果最后一个大项只有一个小项
if(!empty($xiang)){
	?>
    <?php
	$zu=$xiang;
	$i_1=0;
	foreach($zu as $zu){
$str.="http://www.gephenom.com/key/key3.php?category=".$xiao[$i_1]."\r\n";
$i_1++;}?>

<?php	}
//如果最后一个大项只有一个小项
?>    


<?php
$search_query="select * from examination WHERE pass>'0'";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
while($row=mysqli_fetch_array($result)) {
	$str.="http://www.gephenom.com/examination/intro.php?id=".$row['id']."\r\n";
 }?>
 
 <?php
$search_query="select * from tutorial WHERE pass>'0'";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
while($row=mysqli_fetch_array($result)) {
	$str.="http://www.gephenom.com/tutorial/intro.php?id=".$row['id']."\r\n";
 }?>
 
 <?php
$search_query="select * from solution WHERE pass>'0'";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
while($row=mysqli_fetch_array($result)) {
	$str.="http://www.gephenom.com/key/intro.php?id=".$row['id']."\r\n";
 }?>


<?php
$myfile = 'sitemap.txt';
$txt = '';
file_put_contents($myfile, $txt);
$file_pointer = fopen($myfile,"a");
fwrite($file_pointer,$str);
fclose($file_pointer);
?>