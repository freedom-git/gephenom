<?php 
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../repeat_code/manage_head.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="/js/jquery-1.9.1.min.js"></script>
<link href="/css/share.css" rel="stylesheet" type="text/css" />
<title>软件教程</title>
<link href="key_topics.css" rel="stylesheet" type="text/css">

</head>
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

<body>	
<?php
require_once("../../repeat_code/nav.php")
?>
<div id="frame">
   
    <div id="page"> 
        <div id="_21">
        <div class="_2100"></div>
        
<?php
//左边
foreach($row0 as $row){
	
	if(!($class0==$row['class0'])){$i++;$class0=$row['class0'];?>
<div class="_210" id="_<?php echo $i?>"><div class="jiantou">&gt;</div>
        <p class="word"><?php echo $row['class0']?></p><br /></div>
        
<?php }}
?>        
        </div>
        
        
        
        <div id="_22">
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

	<div class="_211" id="_0<?php echo $i?>">
    <div class="_2110"></div>
    <div class="_2111">
    <?php
	$zu=$xiang;
	$i_1=0;
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="one.php?category=<?php echo $xiao[$i_1]?>"><?php echo $zu?></a>
 <?php $i_1++;}?>
    </div>
</div>  
   
              
<?php 
unset($xiao);unset($xiang);$xiang[]=$row['class1'];$xiao[]=$row['id'];	}}
?> 
<?php
//如果最后一个大项只有一个小项
if(!empty($xiang)){
	?>
	<div class="_211" id="_0<?php echo ++$i?>">
    <div class="_2110"></div>
    <div class="_2111">
    <?php
	$zu=$xiang;
	$i_1=0;
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="one.php?category=<?php echo $xiao[$i_1]?>"><?php echo $zu?></a>
 <?php $i_1++;}?>
    </div>
</div>  
<?php	}
//如果最后一个大项只有一个小项
?>

     
        
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
//弹框
$(document).ready(dosomething);

function dosomething()
{
	$('._211').hide();
	$('#_1').mouseenter(function(){
		$('._211').hide();
		$("#_01").css('margin-top','13px');
		$("#_01").show();
		})
	$('#_2').mouseenter(function(){
		$('._211').hide();
		$("#_02").css('margin-top','55px');
		$("#_02").show();
		})
	$('#_3').mouseenter(function(){
		$('._211').hide();
		$("#_03").css('margin-top','115px');
		$("#_03").show();
		})
	$('#_4').mouseenter(function(){
		$('._211').hide();
		$("#_04").css('margin-top','170px');
		$("#_04").show();
		})
	$('#_5').mouseenter(function(){
		$('._211').hide();
		$("#_05").css('margin-top','220px');
		$("#_05").show();
		})
	$('#_6').mouseenter(function(){
		$('._211').hide();
		$("#_06").css('margin-top','270px');
		$("#_06").show();
		})
	$('#_7').mouseenter(function(){
		$('._211').hide();
		$("#_07").css('margin-top','405px');
		$("#_07").show();
		})
	$('#_8').mouseenter(function(){
		$('._211').hide();
		$("#_08").css('margin-top','480px');
		$("#_08").show();
		})
	$('#_9').mouseenter(function(){
		$('._211').hide();
		$("#_09").css('margin-top','545px');
		$("#_09").show();
		})
	$('#_10').mouseenter(function(){
		$('._211').hide();
		$("#_010").css('margin-top','560px');
		$("#_010").show();
		})
	$('#_11').mouseenter(function(){
		$('._211').hide();
		$("#_011").css('margin-top','645px');
		$("#_011").show();
		})
	$('#_12').mouseenter(function(){
		$('._211').hide();

		$("#_012").css('margin-top','725px');
		$("#_012").show();
		})
	$('#_13').mouseenter(function(){
		$('._211').hide();
		$("#_013").css('margin-top','800px');
		$("#_013").show();
		})
	$('#_14').mouseenter(function(){
		$('._211').hide();
		$("#_014").css('margin-top','660px');
		$("#_014").show();
		})
	
}
</script>