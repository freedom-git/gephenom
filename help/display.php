<?php
require_once("../repeat_code/head.php");
?>
<title>上传指导-聚峰网</title>
<meta name="description" content="这里有若干视频介绍如何录制及上传教程到聚峰网。"/>
<meta name="keywords" content="聚峰网上传指导"/>
<link type="text/css" rel="stylesheet" href="display.css"/>
<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="/js/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="shz48gSRhfyGvIey3IGQlPh9RBxf2y7HPX3uHQ==";</script>
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
               <p class="nam">聚峰帮助</p>

        </div>
        <div class="welcome_middle"> <img alt="聚峰网" src="/image/logo.png" width="60px" height="60px" />
        </div>
        <div class="welcome_bottom">
        <a href="personal_index.php"><p class="mor">返回</p></a>
        </div>
   </div>  <!--end_left_welcome-->
   <div class="left_select">
       
        <div>
            <h1>如何录制屏幕</h1>
            <div class="tow">
                <p id="personal_1" class="tow_p">软件的下载安装</p>
                <p id="personal_2" class="tow_p">设置参数及后期处理</p>
            </div>
        </div>
        <div>
            <h1>生成课程</h1>
            <div class="tow">
                <p id="personal_3" class="tow_p">生成免费课程文件</p>
                <p id="personal_4" class="tow_p">生成付费课程文件</p>
            </div>
        </div>
        <div>
            <h1>录制技巧</h1>
            <div class="tow">
                <p id="personal_5" class="tow_p">录制大学课程的方法—手写ppt</p>
                
            </div>
        </div> 
        <div>
            <h1>上传到聚峰</h1>
            <div class="tow">
                <p id="personal_7" class="tow_p">上传软件教程</p>
                <p id="personal_8" class="tow_p">上传大学课程</p>
                <p id="personal_9" class="tow_p">上传学习资料</p>
            </div>
        </div>
        <!--  <div>
          <h1>任务</h1>
            <div class="tow">
                <p id="personal_9" class="tow_p">我的提交的任务</p>
                <p id="personal_10" class="tow_p">我完成的任务</p>
            </div>
        </div>-->
            
            
            
            
        
   </div>  <!--end_left_select-->
</div>  <!--end_personal_left-->

<div class="personal_right"></div>  <!--end_personal_right-->
<script type="text/javascript">
$(document).ready(function ()
{
	$('.personal_right').load('ajax_display.php?id=1');
		$(function(){
	$('#personal_1').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=1');
	}); 	 
	});
	//已经上传的考试
	$(function(){
	$('#personal_2').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=2');
	}); 	 
	});
	//已经上传的答案
	$(function(){
	$('#personal_3').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=3');
	}); 	 
	});
	//已经回答
	$(function(){
	$('#personal_4').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=4');
	}); 	 
	});
	//已经任务
	$(function(){
	$('#personal_5').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=5');
	}); 	 
	});
	$(function(){
	$('#personal_7').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=7');
	}); 	 
	});
	$(function(){
	$('#personal_8').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=8');
	}); 	 
	});
    $(function(){
	$('#personal_9').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_display.php?id=9');
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