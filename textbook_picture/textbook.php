<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/function.php");
require_once("../repeat_code/head.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>考试</title>
<link href="/css/share.css" rel="stylesheet" type="text/css" />
<link href="textbook.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div id="frame">

  <?php
  
require_once("../repeat_code/nav.php");

if(isset($_GET['free'])&&preg_match("/^\d*$/",$_GET['free'])){$free = mysqli_real_escape_string($dbc,trim($_GET['free']));}

if(isset($_GET['type'])&&($_GET['type']=='x'||$_GET['type']=='s'))
{$type=mysqli_real_escape_string($dbc,trim($_GET['type']));}else{exit;}
if(isset($_GET['new'])&&preg_match("/^\d*$/",$_GET['new']))
{$new=mysqli_real_escape_string($dbc,trim($_GET['new']));}else{exit;}
if(isset($_GET['category'])&&preg_match("/^\d*$/",$_GET['category']))
{$category=mysqli_real_escape_string($dbc,trim($_GET['category']));}
if(isset($_POST['serch_text'])){$serch_text=mysqli_real_escape_string($dbc,trim($_POST['serch_text']));}//搜索
$_SESSION['data_mark']=0;

?>
  <div id="page">
    <div class="page_container">
      <div class="left_container"><img width="220px" height="1000px" src="/image/u=2,978344677&fm=19&gp=0.jpg"/></div>
      <div class="search_container">
        <div class="tell">
          <p class="tell1">请选择您教程所属的课本<br />
          </p>
          <p class="tell2">如果下面没有您需要的课本，请<a href="/<?php if($type=='x'){echo 'examination';}
	  if($type=='s'){echo 'key';}
	  if((!$type=='x')&&(!$type=='s')){exit;}?>/upload/upload_two.php?id=11&new=<?php echo $new;if(isset($category)){echo '&category='.$category;}?>&free=<?php echo $free?>">点击这里</a>继续</p>
        </div>
        <div class="search_box">
          <div id="search">
            <form method="post" action="<?php echo $_server['php_self'];?>">
              <input type="text" id="serch_text" name="serch_text" class="input_box" value="<?php echo $serch_text;?>" />
              <input type="submit" id="serch" name="search" class="search_button" value="搜&nbsp;&nbsp;&nbsp;索" />
            </form>
          </div>
        </div>
        <div id="container"> </div>
      </div>
      <?php
  require_once("../repeat_code/footer.php")
  ?>
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
	return((($(document).height() - $(window).height()) - $(window).scrollTop()) <= 400) ? true : false;
}


function getData()
{
$(window).unbind('scroll');
$('#loading').show();

$.get(
'data.php?type=<?php echo $type?>&search=<?php echo urlencode($serch_text)?>&new=<?php echo $new;if(isset($category)){echo '&category='.$category;}?>&free=<?php echo $free?>',
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
