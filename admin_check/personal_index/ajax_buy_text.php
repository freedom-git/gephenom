<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require_once("../../repeat_code/function.php");
require_once("../../repeat_code/session_start.php");//会话
require_once("../../repeat_code/mysqli_connect.php");//数据库

//搜索
if(isset($_POST['search'])){
$search_text=mysqli_real_escape_string($dbc,trim($_POST['search']));
}
 ?>
<div class="buy_video">
  <p class="buy_video_tittle">我购买的大学课程</p>
  <div class="buy_video_search">
    <p class="search_p">交易搜索：</p>
    <div class="search_container">
      <form action="<?php echo $_SERVER['php_self']?>" method="post">
        <input value="<?php echo $search_text?>" type="text" class="search_box" name="search" id="search" />
        <input id="submit" name="submit" type="button" class="button_12" value="搜索" />
      </form>
    </div>
  </div>
<p class="search_res1 res_left">已为您列出:</p><p class="search_res2"></p><p class="search_res1">笔交易记录</p>
  <ul class="buy_video_ul">
    <li class="video_li video_1">名称</li>
    <li class="video_li video_2">专题</li>
    <li class="video_li video_3">作者</li>
    <li class="video_li video_4">价格</li>
    <li class="video_li video_5">学习次数</li>
  </ul>
  <?php
$_SESSION['data_mark']=0;//建立标志变量
$_SESSION['i']=0;

?>
</div>
<script type="text/javascript">
//无限滚动页面
var counter = 0;
$('#loading').hide();
$(document).ready(function() {	
    $(window).scroll(loadData);
	if(counter <= 0){getData();}
});



function loadData()
{
	if(counter < 30000000000)
	{
		if(isUserAtBottom())
		{
			getData();
		}
	}
}
function isUserAtBottom()
{
	return((($(document).height() - $(window).height()) - $(window).scrollTop()) <= 50) ? true : false;
}


function getData()
{
$(window).unbind('scroll');
$('#loading').show();

$.get(
'ajax_buy_text_data.php?search=<?php echo urlencode($search_text)?>',
{},
function(response)
{
$('.search_res2').html("<?php echo $_SESSION['i'];?>");
counter++;
$('#loading').hide();
$('.buy_video').append(response);
$(window).scroll(loadData);	
});
}


//无限滚动页面
</script> 
<script type="text/javascript">
//搜索按钮  post 地址

$('#submit').bind
	('click',function()
	{
	$("#submit").attr("disabled", true);			
	var buy_video=$('#search').serialize();
	$.post('ajax_buy_text.php',buy_video,function(buy_video){
	$('.personal_right').empty();
	$('.personal_right').html(buy_video)
	},'html');
		});	 	 
$('#search').keyup(function()
	{
		$("#submit").removeAttr("disabled");
		}
	);	
	

</script>
<div id="unbind"> </div>
<?php

	}
else{echo '该页面不允许直接浏览';}
?>
