<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
	
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
//教程
$query="SELECT e.price,b.grade ".
"FROM tutorial AS e ".
"INNER JOIN buy_tutorial AS b ON(b.tutorial_id=e.id) ".
"WHERE e.user_id=$_SESSION[id]";
$result=mysqli_query($dbc,$query) or die('出错1');
$arr= array();
while($row=mysqli_fetch_array($result)){$arr[] =$row;}
$row0=$arr; 
$volume_of_business=0;//交易量
$average=0;$average_i=0;//平均分
$general_income=0;//总收入
foreach($row0 as $row1){$volume_of_business++;}//交易量
foreach($row0 as $row1){$average+=$row1['grade'];$general_income+=$row1['price'];if($row1['grade']==0){$average_i++;}}//平均分//总收入
if($volume_of_business==0){$average='暂无';}else{$average/=($volume_of_business-$average_i);}//平均分
$general_income/=3;//总收入
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
"WHERE e.user_id=$_SESSION[id]";
$result1=mysqli_query($dbc,$query1) or die('出错2');
$arr2= array();
while($row2=mysqli_fetch_array($result1)){$arr2[] =$row2;}
$row3=$arr2; 
$volume_of_business1=0;//交易量
$average1=0;$average_i1=0;//平均分
$general_income1=0;//总收入
foreach($row3 as $row4){$volume_of_business1++;}//交易量
foreach($row3 as $row4){$average1+=$row4['grade'];$general_income1+=$row4['price'];if($row4['grade']==0){$average_i1++;}}//平均分//总收入
if($volume_of_business1==0){$average1='暂无';}else{$average1/=($volume_of_business1-$average_i1);}//平均分
$general_income1/=3;//总收入
$general_income1=sprintf("%.2f", $general_income1);
$average1=sprintf("%.2f", $average1);
//考试
//答案
$query2="SELECT e.price,b.grade ".
"FROM solution AS e ".
"INNER JOIN buy_solution AS b ON(b.solution_id=e.id) ".
"WHERE e.user_id=$_SESSION[id]";
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
$general_income2/=3;//总收入
$general_income2=sprintf("%.2f", $general_income2);
$average2=sprintf("%.2f", $average2);
//答案

//花费

//教程
$query3="SELECT e.price ".
"FROM tutorial AS e ".
"INNER JOIN buy_tutorial AS b ON(b.tutorial_id=e.id) ".
"WHERE b.user_id=$_SESSION[id]";
$result3=mysqli_query($dbc,$query3) or die('出错3');
$arr4= array();
while($row8=mysqli_fetch_array($result3)){$arr4[] =$row8;}
$row9=$arr4; 
$consumption=0;
foreach($row9 as $row10){$consumption+=$row10['price'];}
$consumption=sprintf("%.2f", $consumption);
/*echo '总花费'.$average.'<br />';*/
//教程
//考试
$query4="SELECT e.price ".
"FROM examination AS e ".
"INNER JOIN buy_examination AS b ON(b.examination_id=e.id) ".
"WHERE b.user_id=$_SESSION[id]";
$result4=mysqli_query($dbc,$query4) or die('出错4');
$arr5= array();
while($row11=mysqli_fetch_array($result4)){$arr5[] =$row11;}
$row12=$arr5; 
$consumption1=0;
foreach($row12 as $row13){$consumption1+=$row13['price'];}
$consumption1=sprintf("%.2f", $consumption1);
//考试
//答案
$query5="SELECT e.price ".
"FROM solution AS e ".
"INNER JOIN buy_solution AS b ON(b.solution_id=e.id) ".
"WHERE b.user_id=$_SESSION[id]";
$result5=mysqli_query($dbc,$query5) or die('出错5');
$arr6= array();
while($row14=mysqli_fetch_array($result5)){$arr6[] =$row14;}
$row15=$arr6; 
$consumption2=0;
foreach($row15 as $row16){$consumption2+=$row16['price'];}
$consumption2=sprintf("%.2f", $consumption2);
//答案
?>
<div class="personal_left">
   <div class="left_welcome">
        <div class="welcome_top"> 		
  <?php 
  $query_tixian="SELECT * FROM user WHERE id='$_SESSION[id]' LIMIT 1";
  $result_tixian=mysqli_query($dbc,$query_tixian) or die('出错_tixian');
  $row1_tixian=mysqli_fetch_array($result_tixian);
  $_SESSION['nickname']=$row1_tixian['nickname'];
  $_SESSION['money']=$row1_tixian['money'];  
  ?>                                
               <p class="nam"><?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['nickname'];}?></p>

        </div>
        <div class="welcome_middle"> <img src="/image/logo.png" width="60px" height="60px" />
        </div>
        <div class="welcome_bottom">
        <a href="personal_index.php"><p class="mor">返回</p></a>
        </div>
   </div>  <!--end_left_welcome-->
   <div class="left_select">
       
        <div>
            <h1>软件教程</h1>
            <div class="tow">
                <p id="personal_1" class="tow_p">我购买的教程</p>
                <p id="personal_2" class="tow_p">我上传的教程</p>
            </div>
        </div>
        <div>
            <h1>大学课程</h1>
            <div class="tow">
                <p id="personal_3" class="tow_p">我购买的课程</p>
                <p id="personal_4" class="tow_p">我上传的课程</p>
            </div>
        </div>
        <div>
            <h1>学习资料</h1>
            <div class="tow">
                <p id="personal_5" class="tow_p">我购买的资料</p>
                <p id="personal_6" class="tow_p">我上传的资料</p>
            </div>
        </div> 
       <!-- <div>
            <h1>问题</h1>
            <div class="tow">
                <p id="personal_7" class="tow_p">我的提问</p>
                <p id="personal_8" class="tow_p">我回答问题</p>
            </div>
        </div>
        <div>
            <h1>任务</h1>
            <div class="tow">
                <p id="personal_9" class="tow_p">我的提交的任务</p>
                <p id="personal_10" class="tow_p">我完成的任务</p>
            </div>
        </div>-->
            
            
            
            
        
   </div>  <!--end_left_select-->
</div>  <!--end_personal_left-->

<div class="load">
</div>
<div class="personal_right">
     <div class="right_count">
            <div class="count_a">
                <div class="shengyu">
                     <p class="shengyu_fon1"><strong>账户余额：</strong></p>
                     <p class="shengyu_fon2"><?php echo $_SESSION['money'];?></p>
                     <p class="shengyu_fon3">学币</p>
                     <button class="chongzhi" type="button">充 值</button>
                     <button class="tixian" type="button">提 现</button>
                </div>  <!--end_shengyu-->
                <div class="pingfen">
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
         </tr>-->
       </table>
       </div>
                </div>  <!--end_pingfen-->
            </div>  <!--end_count_a-->
            <div class="count_xian">
            </div>
            <div class="count_b">
                <div class="b_con">
                   <p class="count_font1">您在本网站的总收入：</p>
                   <p class="count_font2"><?php echo $general_income+$general_income1+$general_income2;?></p>
                   <p class="count_font3">学币</p>
                </div>
                <div class="b_con">
                   <p class="count_font1">您在本网站的总支出：</p>
                   <p class="count_font2"><?php echo $consumption+$consumption1+$consumption2;?></p>
                   <p class="count_font3">学币</p>
                </div>
                <button type="button" class="mingxi">查 看 明 细</button>
            </div>  <!--end_count_b-->
     </div>  <!--end_right_count-->
     <div class="right_recent">
     </div>
</div>  <!--end_personal_right-->





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
	//已经购买的教程
		$(function(){
	$('#personal_1').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_buy_video.php');
	}); 	 
	});
	//已经上传的教程
	$(function(){
	$('#personal_2').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_video.php');
	}); 	 
	});
	//已经购买的考试
	$(function(){
	$('#personal_3').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_buy_text.php');
	}); 	 
	});
	//已经上传的考试
	$(function(){
	$('#personal_4').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_text.php');
	}); 	 
	});
	//已经购买的答案
	$(function(){
	$('#personal_5').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_buy_answer.php');
	}); 	 
	});
	//已经上传的答案
	$(function(){
	$('#personal_6').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_answer.php');
	}); 	 
	});
	//我的提问
	$(function(){
	$('#personal_7').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_my_question.php');
	}); 	 
	});
	//我的回答
	$(function(){
	$('#personal_8').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_my_answer.php');
	}); 	 
	});
	//我的任务
	$(function(){
	$('#personal_9').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_my_mission.php');
	}); 	 
	});
	//我做的任务
	$(function(){
	$('#personal_10').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_do_mission.php');
	}); 	 
	});
	//充值
    $(function(){
    $('.chongzhi').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_funds.php');
	window["i"]=0;
		 }); 	 
	 });
	 //提现
    $(function(){
    $('.tixian').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_funds.php');
	window["i"]=2;
		 }); 	 
	 });
	 //明细
    $(function(){
    $('.mingxi').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_funds.php');
	window["i"]=1;
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

<?php
	}
else{echo '该页面不允许直接浏览';}
?>
