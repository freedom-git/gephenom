<?php 
require_once("../repeat_code/head.php");
?>
<?php
//区分用户
if(isset($_GET['nickname'])){
$query_id="SELECT * FROM user WHERE nickname='$_GET[nickname]' LIMIT 1";
$result_id=mysqli_query($dbc,$query_id) or die('出错1');
$row_id=mysqli_fetch_array($result_id);
$_SESSION['person']=$row_id['id'];
}else{
if(isset($_SESSION['session_user_id'])){$_SESSION['person']=$_SESSION['session_user_id'];}}
if(!isset($_GET['nickname'])&&!isset($_SESSION['session_user_id'])){exit;}
//区分用户
$query="SELECT e.price,b.grade ".
"FROM tutorial AS e ".
"INNER JOIN buy_tutorial AS b ON(b.tutorial_id=e.id) ".
"WHERE e.user_id=$_SESSION[person]";
$result=mysqli_query($dbc,$query) or die('出错');
$arr= array();
while($row=mysqli_fetch_array($result)){$arr[] =$row;}
$row0=$arr; 
$volume_of_business=0;//交易量
$average=0;$average_i=0;//平均分
$general_income=0;//总收入
foreach($row0 as $row1){$volume_of_business++;}//交易量
foreach($row0 as $row1){$average+=$row1['grade'];$general_income+=$row1['price'];if($row1['grade']==0){$average_i++;}}//平均分//总收入
if($volume_of_business==0){$average='暂无';}else{$average/=($volume_of_business-$average_i);}//平均分
$general_income/=2;//总收入
$general_income=sprintf("%.2f", $general_income);
$average=sprintf("%.2f", $average);
/*foreach($row0 as $row1){echo '价格'.$row1['price'].'分数'.$row1['grade'].'<br />';}
echo '交易量'.$volume_of_business.'<br />';
echo '平均分'.$average.'<br />';
echo '总收入'.$general_income.'<br />';*/
//教程
//考试
$query1="SELECT e.price,b.grade ".
"FROM examination AS e ".
"INNER JOIN buy_examination AS b ON(b.examination_id=e.id) ".
"WHERE e.user_id=$_SESSION[person]";
$result1=mysqli_query($dbc,$query1) or die('出错');
$arr2= array();
while($row2=mysqli_fetch_array($result1)){$arr2[] =$row2;}
$row3=$arr2; 
$volume_of_business1=0;//交易量
$average1=0;$average_i1=0;//平均分
$general_income1=0;//总收入
foreach($row3 as $row4){$volume_of_business1++;}//交易量
foreach($row3 as $row4){$average1+=$row4['grade'];$general_income1+=$row4['price'];if($row4['grade']==0){$average_i1++;}}//平均分//总收入
if($volume_of_business1==0){$average1='暂无';}else{$average1/=($volume_of_business1-$average_i1);}//平均分
$general_income1/=2;//总收入
$general_income1=sprintf("%.2f", $general_income1);
$average1=sprintf("%.2f", $average1);
//考试
//答案
$query2="SELECT e.price,b.grade ".
"FROM solution AS e ".
"INNER JOIN buy_solution AS b ON(b.solution_id=e.id) ".
"WHERE e.user_id=$_SESSION[person]";
$result2=mysqli_query($dbc,$query2) or die('出错');
$arr3= array();
while($row5=mysqli_fetch_array($result2)){$arr3[] =$row5;}
$row6=$arr3; 
$volume_of_business2=0;//交易量
$average2=0;$average_i2=0;//平均分
$general_income2=0;//总收入
foreach($row6 as $row7){$volume_of_business2++;}//交易量
foreach($row6 as $row7){$average2+=$row7['grade'];$general_income2+=$row7['price'];if($row7['grade']==0){$average_i2++;}}//平均分//总收入
if($volume_of_business2==0){$average2='暂无';}else{$average2/=($volume_of_business2-$average_i2);}//平均分
$general_income2/=2;//总收入
$general_income2=sprintf("%.2f", $general_income2);
$average2=sprintf("%.2f", $average2);
//答案
//用户信息
$query_user_information="SELECT * FROM user WHERE id=$_SESSION[person]";
$result_user_information=mysqli_query($dbc,$query_user_information) or die('出错');
$row_user_information=mysqli_fetch_array($result_user_information)
//用户信息
?>
<title><?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['session_nickname'];}?>的个人主页-聚峰网</title>
<meta name="description" content="<?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['session_nickname'];}?>的个人主页,聚峰网致力于打造最优秀的视频教程网站，开创软件教程|大学课程|学习资料三大板块，拥有平面教程，多媒体制作教程，办公信息化教程，机械设计教程，网站制作教程，各专业大学课程，课后答案，学习资料等多种优质资源。"/>
<meta name="keywords" content="视频教程，大学课程，学习资料，课后答案，聚峰网个人主页"/>
<link type="text/css" rel="stylesheet" href="personal_show.css"/>
</head>
<body>
<div id="frame">
<?php
require_once("../repeat_code/nav.php")
?>
   <div id="page">
       <div class="personal_nav">



       </div>
       <div class="container">
       <div class="personal_left">
   <div class="left_welcome">
        <div class="welcome_top">
            

               
               <p class="nam"><?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['session_nickname'];}?></p>

        </div>
        <div class="welcome_middle"> <a href="personal_show.php<?php if(isset($_GET['nickname'])){echo '?nickname='.$_GET['nickname'];}?>"><img src="../image/logo.png" width="60px" height="60px" /></a>
        </div>
        <div class="welcome_bottom">
        <a href="personal_show.php<?php if(isset($_GET['nickname'])){echo '?nickname='.$_GET['nickname'];}?>"><p class="mor">个人主页</p></a>
        </div>
   </div>  <!--end_left_welcome-->
   <div class="left_select">
       
        <div id="funds_1">
            <h1>上传的软件教程</h1> 
        </div>
        <div id="funds_2">
            <h1>上传的大学课程</h1>
        </div>
        <div id="funds_3">
            <h1>上传的学习资料</h1>
        </div> 
       <!-- <div id="funds_4">
            <h1>回答的问题</h1>
        </div>
        <div id="funds_5">
            <h1>完成的任务</h1>
        </div>  -->
            
            
            
            
        
   </div>  <!--end_left_select-->
</div>  <!--end_personal_left-->

<div class="load">
</div>
<div class="personal_right">


       <!--end_right_count-->
       <p class="buy_video_tittle"><?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['session_nickname'];}?>的个人主页</p>
<div class="table">
       <table width="97%" border="0">
         <tr class="table_1">
           <td width="150">&nbsp;</td>
           <td width="117">交易量</td>
           <td width="198">平均分</td>
           <td width="197">总收入</td>
           <td width="122" class="table_01">&nbsp;</td>
         </tr>
         <tr class="table_2">
           <td class="column_1">教程</td>
           <td><?php echo $volume_of_business;?></td>
           <td><?php echo $average;?></td>
           <td><?php echo $general_income;?></td>
           <td class="table_02">&nbsp;</td>
         </tr>
         <tr class="table_3">
           <td class="column_1">考试</td>
           <td><?php echo $volume_of_business1;?></td>
           <td><?php echo $average1;?></td>
           <td><?php echo $general_income1;?></td>
           <td class="table_03">&nbsp;</td>
         </tr>
         <tr class="table_2">
           <td class="column_1">答案</td>
           <td><?php echo $volume_of_business2;?></td>
           <td><?php echo $average2;?></td>
           <td><?php echo $general_income2;?></td>
           <td class="table_02">&nbsp;</td>
         </tr>
        <!-- <tr class="table_3">
           <td class="column_1">问题</td>
           <td>15</td>
           <td>8.65</td>
           <td>￥1050</td>
           <td class="table_03">&nbsp;</td>
         </tr>
         <tr class="table_2">
           <td class="column_1">任务</td>
           <td>15</td>
           <td>8.65</td>
           <td>￥1050</td>
           <td class="table_02">&nbsp;</td>
         </tr> -->
       </table>
       </div>
 <!--   <div class="jianjie">

<p class="shanchang">我擅长的方面：</p>
<p class="neirong">catia三维建模 catia运动仿真 网页的前台制作 网页的后台制作</p>
<p class="fangshi">我的联系方式：</p>
<p class="neirong1">手机：<?php echo $row_user_information['phone_number'];?></p>
<p class="neirong1">邮箱：<?php echo $row_user_information['email'];?></p>
<p class="neirong1">Q Q：<?php echo $row_user_information['qq'];?></p>
</div>-->

</div>  
<!--end_personal_right-->





<script type="text/javascript">
$(document).ready(function ()
{
	//实现转圈图片
	/*$(".personal_right").ajaxStart(function(){
	$('.load').html("<img src='/image/loading.gif' />")
	});
	$(".personal_right").ajaxSuccess(function(){
	$('.load').empty();
	});*/
	//已经上传的教程
		$(function(){
	$('#funds_1').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_video.php');
	}); 	 
	});
	//已经上传的考试
	$(function(){
	$('#funds_2').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_text.php');
	}); 	 
	});
	//已经上传的答案
	$(function(){
	$('#funds_3').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_answer.php');
	}); 	 
	});
	//已经回答
	$(function(){
	$('#funds_4').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_text.php');
	}); 	 
	});
	//已经任务
	$(function(){
	$('#funds_5').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_buy_answer.php');
	}); 	 
	});


//下拉列表
	$('.tow').hide();
	
	$('h1').click(function()
	{
		var h1 = $(this);
		h1.next('div').slideToggle('fast');
	});
});
			
		 //实现焦点
	 
$(function(){
    $('.tow > p').click(function(){ 
	   $('.tow > p').removeClass("tow_p_focus");
	   $(this).addClass("tow_p_focus");
		 }); 	 
	 });	


</script>
       </div>
   </div>
</div>

<?php require_once("../repeat_code/footer.php");?>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 



	 
	 //实现焦点
	 
$(function(){
    $('.tow_p').click(function(){ 
	   $('.tow > p').removeClass("tow_p_focus");
	   $(this).addClass("tow_p_focus");
		 }); 	 
	 }); 
});
</script>
