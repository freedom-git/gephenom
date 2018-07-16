<?php
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../repeat_code/function.php");
require_once("../../repeat_code/manage_head.php");
?>
<?php
//区分数据库
if(isset($_GET['category'])){
	$category=mysqli_real_escape_string($dbc,trim($_GET['category']));
	}
if(isset($_GET['search'])){$serch_text=$_GET['search'];}
if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort=4;$order='ORDER BY date DESC';}
if(isset($_POST['serch_text'])){$serch_text=$_POST['serch_text'];}//搜索
$_SESSION['data_mark']=0;//建立标志变量
//查专题
if(isset($_GET['category'])){
$query_category="SELECT * FROM solution_category1 WHERE id='$category' LIMIT 1";
$result_category=mysqli_query($dbc,$query_category) or die('出错1');
$row_category=mysqli_fetch_array($result_category);
//查专题
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_category['class1']?>专题</title>
<link href="/css/share.css" rel="stylesheet" type="text/css" />
<link href="key3.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.9.1.min.js"></script>
</head>



<body>
<div id="frame">
<?php
require_once("../../repeat_code/nav.php")
?>
   <div id="page">
     <div class="page_container">
      <div class="left_container">
            <img src="/key/img/u=2,972073506&fm=19&gp=0.jpg" width="220px" height="2000px">
      </div>
      <div class="search_container">
          <p class="video_tittle"><?php echo $row_category['class1']?>的学习资料</p>
          <div class="search_box">
             <div id="search">
        <form method="post" action="<?php echo $_server['php_self'];?>">
        <input type="text" id="serch_text" name="serch_text" class="input_box" value="<?php echo $serch_text;?>" />
        <input type="submit" id="serch" name="search" class="search_button" value="搜&nbsp;&nbsp;&nbsp;索" />
        </form>
          </div>
          </div>
          <div class="order">
            <ul class="right_container">
                          <li class="menuHeader moren">
                              <p class="biaoqian"><a href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">默认</a></p>
                         </li>
                        <li class="menuHeader price">
                              <p class="biaoqian">价格</p>
                              <ul class="menuItem">
                                 <li><a href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">价格 ↑</a></li>
                                 <li><a href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">价格 ↓</a></li>
                              </ul>
                         </li>
                         <li class="menuHeader date">
                              <p class="biaoqian">发布时间</p>
                              <ul class="menuItem">
                                 <li><a href="<?php $url="?category=$category&sort=3&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">发布时间 ↑</a></li>
                                 <li><a href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">发布时间 ↓</a></li>
                              </ul>
                         </li>
                    </ul>
              </div>
          

     
      
       <div id="container">
       </div>
      
    </div>
  </div>
</div>
</div>
</body>
</html>



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
'data.php?category=<?php if(!empty($category)){echo $category;}?>&sort=<?php echo $sort?>&search=<?php echo urlencode($serch_text)?>',
{},
function(response)
{
           counter++;
$('#loading').hide();
$('#container').append(response);
$(window).scroll(loadData);	
});
}


//无限滚动页面
</script>


<script type="text/javascript">
//下拉菜单
$(document).ready(function(){
			$('ul.menuItem').hide();
			$(".menuHeader > li").click(function(){
				$('.menuItem:visible').Toggle();
				$('ul', $(this).parent()).Toggle();
			});
			
			$("li.menuHeader").hover(
			function(){
					$('ul', this).show();
			},
			function(){
					$('ul', this).hide();
			});
		

	
	//现实详细信息
	$(".show_content").mouseenter(function() {	
		 $(this).find(".content_infor").stop();
         $(this).find(".content_infor").animate({top:"-153px"});
    });
	$(".show_content").mouseleave(function() {
		$(this).find(".content_infor").stop();
		 $(this).find(".content_infor").animate({top:"0"});
    });		
});		
</script>


<script src="/login/log_in.js"></script>