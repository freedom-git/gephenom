<?php
require_once("../repeat_code/function.php");
require_once("../repeat_code/head.php");
?>
<?php
//区分数据库
if(isset($_GET['category'])){
	$category=mysqli_real_escape_string($dbc,trim($_GET['category']));
	}
//区分数据库
if(isset($_GET['search'])){$serch_text=$_GET['search'];}
if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort=3;$order='ORDER BY date ASC';}
if(isset($_POST['serch_text'])){$serch_text=$_POST['serch_text'];}//搜索
$_SESSION['data_mark']=0;//建立标志变量
//查专题
$query_category="SELECT * FROM solution_category1 WHERE id='$category' LIMIT 1";
$result_category=mysqli_query($dbc,$query_category) or die('出错');
$row_category=mysqli_fetch_array($result_category);
$query1="SELECT * FROM solution_category0 WHERE id='$row_category[class0_id]' LIMIT 1";
$result1=mysqli_query($dbc,$query1) or die('出错');
$row1=mysqli_fetch_array($result1);
$query2="SELECT * FROM solution_category1 WHERE class0_id='$row1[id]'";
$result2=mysqli_query($dbc,$query2) or die('出错');
//查专题
?>
<title><?php echo $row_category['class1']?>下载-学习资料-课后答案-聚峰网</title>
<meta name="description" content="这里有<?php echo $row_category['class1']?>下载-聚峰网,打造最优秀的视频教程分享网站。"/>
<meta name="keywords" content="<?php echo $row_category['class1']?>，聚峰网"/>
<link href="key3.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="frame">
<?php
require_once("../repeat_code/nav.php")
?>
   <div id="page">
     <div class="page_container">
 
<div class="left">
        <div class="left_select">
            <h1><b><i><?php echo $row1['class0'];?>><br /><br /><?php echo $row_category['class1'];?></i></b></h1>
            <div class="tow">
            <?php
			while($row2=mysqli_fetch_array($result2)) 
			{
			   ?>
               <p id="personal_2" class="tow_p"><a href="key3.php?category=<?php echo $row2['id'];?>"><?php echo $row2['class1'];?></a></p>
               <?php
				}
			?>
            </div>

   </div>  <!--end_left_select-->
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
                              <p class="biaoqian"><a rel="nofollow" href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">默认</a></p>
                         </li>
                        <li class="menuHeader price">
                              <p class="biaoqian">价格</p>
                              <ul class="menuItem">
                                 <li><a rel="nofollow" href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">价格 ↑</a></li>
                                 <li><a rel="nofollow" href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">价格 ↓</a></li>
                              </ul>
                         </li>
                         <li class="menuHeader date">
                              <p class="biaoqian">发布时间</p>
                              <ul class="menuItem">
                                 <li><a rel="nofollow" href="<?php $url="?category=$category&sort=3&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">发布时间 ↑</a></li>
                                 <li><a rel="nofollow" href="<?php $url="?category=$category&sort=4&search=$serch_text"; echo $_server['php_self'].$url ?>" class="category">发布时间 ↓</a></li>
                              </ul>
                         </li>
                    </ul>
              </div>
          
<div id="hide">
<?php
$search_query="select * from solution WHERE category='$category' AND pass>'0'";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
while($row=mysqli_fetch_array($result)) {
?>
<a href="intro.php?id=<?php echo urlencode($row['id'])?>"><h2><b><i><?php echo $row['heading']?></i></b></h2></a>
<?php }?>
</div>
     
      
       <div id="container">
       </div>
      
    </div>
  </div>
</div>
</div>
<?php 
require_once("../repeat_code/footer.php");
?>
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
	return((($(document).height() - $(window).height()) - $(window).scrollTop()) <= 400) ? true : false;
}


function getData()
{
$(window).unbind('scroll');
$('#loading').show();

$.get(
'data.php?category=<?php echo $category?>&sort=<?php echo $sort?>&search=<?php echo urlencode($serch_text)?>',
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
<script type="text/javascript">$("#hide").css("display","none");</script>