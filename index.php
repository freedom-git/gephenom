<?php 
require_once("repeat_code/head.php");
?>
<title>视频教程-免费视频教程|大学课程|学习资料|课后答案-聚峰网</title>
<meta name="description" content="聚峰网,致力于打造最优秀的视频教程网站，开创软件教程|大学课程|学习资料三大板块，拥有平面教程，多媒体制作教程，办公信息化教程，机械设计教程，网站制作教程，各专业大学课程，课后答案，学习资料等多种优质资源。"/>
<meta name="keywords" content="视频教程，大学课程，学习资料，课后答案，聚峰网"/>
<meta name="baidu-site-verification" content="Ihzc7cGyBt" />
<meta name="360-site-verification" content="e1f5d6e9fd7238520f3213e08967debe" />
<meta name="google-site-verification" content="uAQtg8XZ7Ho2uSwK_tnifJHsH6oRS6U_56Cd-vxhW5c" />
<link type="text/css" rel="stylesheet" href="index.css" />
</head>
<body>
  <div class="frame">
   <div class="page">
        <div class="top_container">
            <h1><b><i><p class="biaoyu">聚峰网</p></i></b></h1>
        </div><!--end top_container-->
        
        
        
        <div id="hide">
        
        
        
        
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

foreach($row0 as $row){
	
	if(!($class0==$row['class0'])){$i++;$class0=$row['class0'];?>
<h1><b><i><?php echo $row['class0']?></i></b></h1>
        
<?php }}
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
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="/examination/video_topics.php?category=<?php echo $xiao[$i_1]?>"><h2><b><i><?php echo $zu?></i></b></h2></a>
 <?php $i_1++;}?>

   
              
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
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="/examination/video_topics.php?category=<?php echo $xiao[$i_1]?>"><h2><b><i><?php echo $zu?></i></b></h2></a>
 <?php $i_1++;}?>

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

foreach($row0 as $row){
	
	if(!($class0==$row['class0'])){$i++;$class0=$row['class0'];?>
<h1><b><i><?php echo $row['class0']?></i></b></h1>
        
<?php }}
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
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="/tutorial/video_topics.php?category=<?php echo $xiao[$i_1]?>"><h2><b><i><?php echo $zu?></i></b></h2></a>
 <?php $i_1++;}?>

   
              
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
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="/tutorial/video_topics.php?category=<?php echo $xiao[$i_1]?>"><h2><b><i><?php echo $zu?></i></b></h2></a>
 <?php $i_1++;}?>

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

foreach($row0 as $row){
	
	if(!($class0==$row['class0'])){$i++;$class0=$row['class0'];?>
<h1><b><i><?php echo $row['class0']?></i></b></h1>
        
<?php }}
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
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="/key/key3.php?category=<?php echo $xiao[$i_1]?>"><h2><b><i><?php echo $zu?></i></b></h2></a>
 <?php $i_1++;}?>

   
              
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
	 foreach($zu as $zu){?>
    <a class="xiaoxiang" href="/key/key3.php?category=<?php echo $xiao[$i_1]?>"><h2><b><i><?php echo $zu?></i></b></h2></a>
 <?php $i_1++;}?>

<?php	}
//如果最后一个大项只有一个小项
?>    

   
        </div>
        
        
        
        
        
        
        <div class="mid_container">
            <a href="/tutorial/tutorial_topics.php"><div class="mid_a mid_share">
                 <div class="img_container">
                    <img  id="img_a" alt="软件教程" src="image/tutorial1.gif" width="150" height="150" />
                 </div>
                 <div class="text_container text_a">
                      <p class="text_title">软件教程</p>
                 </div>
            </div></a><!--end mid_a-->
            <a href="/examination/examination_topics.php"><div class="mid_b mid_share">
                 <div class="img_container">
                    <img  id="img_b" alt="大学课程" src="image/examation1.gif" width="150" height="150" />
                 </div>
                 <div class="text_container  text_b">
                       <p class="text_title">大学课程</p>
                 </div>
            </div></a><!--end mid_b-->
            <a href="/key/key_topics.php"><div class="mid_c mid_share">
                 <div class="img_container">
                    <img  id="img_c" alt="学习资料" src="image/answer1.gif" width="150" height="150" />
                 </div>
                 <div class="text_container text_c">
                       <p class="text_title">学习资料</p>
                 </div>
            </div></a><!--end mid_c-->
            <a href="upload_select.php"><div class="mid_d mid_share">
                 <div class="img_container">
                    <img  id="img_d" alt="我要上传" src="image/upload1.gif" width="150" height="150" />
                 </div>
                 <div class="text_container text_d">
                        <p class="text_title">我要上传</p>
                 </div>
            </div><!--end mid_d--></a>
        </div><!--end mid_container-->

        <div class="bottom_container">
         <!--    <p class="biaoyu">学无止境</p>-->
         <p class="biaoyu"><p class="test">打造最好的学习资源分享平台  聚峰网  有你更精彩</p></p>
        </div><!--end bottom_container-->
   </div><!--end page-->
  </div><!--end frame-->
  
  <script type="text/javascript">
$(document).ready(function ()
{
    $('.text_a').mouseenter(function(e) {
        $("#img_a").attr("src", "image/tutorial2.gif");
    });
	$('.text_a').mouseleave(function(e) {
        $("#img_a").attr("src", "image/tutorial1.gif");
    });
	   $('#img_a').mouseenter(function(e) {
        $("#img_a").attr("src", "image/tutorial2.gif");
    });
	$('#img_a').mouseleave(function(e) {
        $("#img_a").attr("src", "image/tutorial1.gif");
    });
	
	
	
	   $('.text_b').mouseenter(function(e) {
        $("#img_b").attr("src", "image/examation2.gif");
    });
	$('.text_b').mouseleave(function(e) {
        $("#img_b").attr("src", "image/examation1.gif");
    });
	   $('#img_b').mouseenter(function(e) {
        $("#img_b").attr("src", "image/examation2.gif");
    });
	$('#img_b').mouseleave(function(e) {
        $("#img_b").attr("src", "image/examation1.gif");
    });
	
	
	
	
	
	   $('.text_c').mouseenter(function(e) {
        $("#img_c").attr("src", "image/answer2.gif");
    });
	$('.text_c').mouseleave(function(e) {
        $("#img_c").attr("src", "image/answer1.gif");
    });
	   $('#img_c').mouseenter(function(e) {
        $("#img_c").attr("src", "image/answer2.gif");
    });
	$('#img_c').mouseleave(function(e) {
        $("#img_c").attr("src", "image/answer1.gif");
    });
	
	
	
	
	   $('.text_d').mouseenter(function(e) {
        $("#img_d").attr("src", "image/upload2.gif");
    });
	$('.text_d').mouseleave(function(e) {
        $("#img_d").attr("src", "image/upload1.gif");
    });
	   $('#img_d').mouseenter(function(e) {
        $("#img_d").attr("src", "image/upload2.gif");
    });
	$('#img_d').mouseleave(function(e) {
        $("#img_d").attr("src", "image/upload1.gif");
    });
	
	



	
});
</script>
<p style="display:none"><a href="http://www.xuanyy.cn">优轩网</a></p>
<?php 
require_once("repeat_code/footer.php");
?>
</body>


</html>
<script type="text/javascript">$("#hide").css("display","none");</script>
