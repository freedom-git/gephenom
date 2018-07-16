<?php 
require_once("repeat_code/head.php");
?>
<title>视频教程-聚峰网-视频教程|学习资料-上传指导</title>
<meta name="description" content="聚峰网视频教程上传指导，在这里有大量的视频教程指导大家如何录制自己的教程并发布在聚峰网上"/>
<meta name="keywords" content="聚峰网，视频教程，上传指导"/>
<link href="upload_select.css" rel="stylesheet" type="text/css">
</head>
<body>	
<?php
require_once("repeat_code/nav.php")
?>
<div id="frame">
   
    <div id="page"> 
         <div class="top_container">
         </div>
         <div class="ruhe_container">
             <a target="_blank" href="help/display.php"><div class="gudience">
                
                <img alt="聚峰网上传指导" id="img_d" src="image/upload2.gif" width="110" height="110" />
                <p class="biaoyu">上传指导</p>
             </div></a>
         
         
             <!--   <div class="mid_d mid_share">
                 <div class="img_container">
                    
                 </div>
                 <div class="text_container text_d">
                        <p class="text_title">上传</p>
                 </div>
                </div>end mid_d-->
         </div>
         <div class="mid_container">
            <a href="/tutorial/upload/upload.php"><div class="mid_a mid_share">
                 <div class="img_container">
                    <img alt="聚峰网上传软件教程"  id="img_a" src="image/tutorial2.gif" width="150" height="150" />
                 </div>
                 <div class="text_container text_a">
                      <p class="text_title">上传软件教程</p>
                 </div>
            </div></a><!--end mid_a-->
            <a href="/examination/upload/upload.php"><div class="mid_b mid_share">
                 <div class="img_container">
                    <img alt="聚峰网上传大学课程"  id="img_b" src="image/examation2.gif" width="150" height="150" />
                 </div>
                 <div class="text_container  text_b">
                       <p class="text_title">上传大学课程</p>
                 </div>
            </div></a><!--end mid_b-->
            <a href="/key/upload/upload.php"><div class="mid_c mid_share">
                 <div class="img_container">
                    <img alt="聚峰网上传学习资料"  id="img_c" src="image/answer2.gif" width="150" height="150" />
                 </div>
                 <div class="text_container text_c">
                       <p class="text_title">上传学习资料</p>
                 </div>
            </div></a><!--end mid_c-->
            
        </div><!--end mid_container-->
        
    </div>
</div>



  <script type="text/javascript">
$(document).ready(function ()
{
    $('.text_a').mouseenter(function(e) {
        $("#img_a").attr("src", "image/tutorial1.gif");
    });
	$('.text_a').mouseleave(function(e) {
        $("#img_a").attr("src", "image/tutorial2.gif");
    });
	   $('#img_a').mouseenter(function(e) {
        $("#img_a").attr("src", "image/tutorial1.gif");
    });
	$('#img_a').mouseleave(function(e) {
        $("#img_a").attr("src", "image/tutorial2.gif");
    });
	
	
	
	   $('.text_b').mouseenter(function(e) {
        $("#img_b").attr("src", "image/examation1.gif");
    });
	$('.text_b').mouseleave(function(e) {
        $("#img_b").attr("src", "image/examation2.gif");
    });
	   $('#img_b').mouseenter(function(e) {
        $("#img_b").attr("src", "image/examation1.gif");
    });
	$('#img_b').mouseleave(function(e) {
        $("#img_b").attr("src", "image/examation2.gif");
    });
	
	
	
	
	
	   $('.text_c').mouseenter(function(e) {
        $("#img_c").attr("src", "image/answer1.gif");
    });
	$('.text_c').mouseleave(function(e) {
        $("#img_c").attr("src", "image/answer2.gif");
    });
	   $('#img_c').mouseenter(function(e) {
        $("#img_c").attr("src", "image/answer1.gif");
    });
	$('#img_c').mouseleave(function(e) {
        $("#img_c").attr("src", "image/answer2.gif");
    });
	
	
	
	
	
	
});
</script>
<?php 
require_once("repeat_code/footer.php");
?>
</body>
</html>