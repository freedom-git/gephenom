<?php
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
?>
<div class="personal_left">
   <div class="left_welcome">
               <div class="welcome_top"> 
               <p class="nam"><?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['session_nickname'];}?></p>

        </div>
        <div class="welcome_middle"><img src="/image/logo.png" width="60px" height="60px" />
        </div>
        <div class="welcome_bottom">
        <a id="fund" href="#"><p class="mor">返回</p></a>
        </div>
   </div>  <!--end_left_welcome-->
   <div class="left_select">
      
        <div id="funds_1">
            <h1>我要充值</h1> 
        </div>
        <div id="funds_2">
            <h1>我要提现</h1>
        </div>
        <div id="funds_3">
            <h1>资金明细</h1>
        </div>  <!--
        <div id="funds_4">
            <h1>充值明细</h1>
        </div>
        <div id="funds_5">
            <h1>提现明细</h1>
        </div>-->
            
            
            
            
        
   </div>  <!--end_left_select-->
</div>  <!--end_personal_left-->

<div class="personal_right">
</div>






<script type="text/javascript">
$(document).ready(function ()
{
	
	
		$(function(){
			if(i==1){$('.personal_right').load('ajax_funds_mingxi.php');}
			if(i==2){$('.personal_right').load('ajax_funds_tixian.php');}
			if(i==0){$('.personal_right').load('ajax_funds_chongzhi.php');}
	//充值
	$('#funds_1').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_funds_chongzhi.php');
	}); 	 
	});
	//已经上传的教程
	$(function(){
	$('#funds_2').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_funds_tixian.php');
	}); 	 
	});
	//已经购买的考试
	$(function(){
	$('#funds_3').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_funds_mingxi.php');
	}); 	 
	});
	//已经上传的考试
	$(function(){
	$('#funds_4').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_upload_text.php');
	}); 	 
	});
	//已经购买的答案
	$(function(){
	$('#funds_5').click(function(){ 
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


$(function(){
    $('#fund').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_funds.php');
		 }); 	 
	 });
</script>