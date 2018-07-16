<?php
require_once("../repeat_code/function.php");//包含函数文件
require_once("../repeat_code/head.php")
?>
<?php
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($dbc,trim($_GET['id']));
	}else{exit;}
$query="SELECT e.*,b.*,u.nickname ".
"FROM solution AS e ".
"INNER JOIN buy_solution AS b ON(b.solution_id=e.id) ".
"INNER JOIN user AS u ON(u.id=b.user_id) ".
"WHERE e.id='$id'";
$result=mysqli_query($dbc,$query) or die('出错');
$jiaoyiliang=mysqli_num_rows($result);
$arr= array();
while($row0=mysqli_fetch_array($result)){$arr[] =$row0;}
$i=0;
foreach($arr as $row){if(!empty($row['grade'])){$i++;$pinfen+=$row['grade'];}}
if($jiaoyiliang==0||$i==0){$pinfen='暂无';}else{
$pinfen/=$i;$pinfen=sprintf("%.2f", $pinfen);
}
$query1="SELECT * FROM solution WHERE id='$id' LIMIT 1";
$result1=mysqli_query($dbc,$query1) or die('出错');
$row1=mysqli_fetch_array($result1);
if($row1['pass']<=0){exit;}//防止观看未通过审核视屏
$title_picture=$row1['title_picture'];
$category_id=$row1['category'];
$query2="SELECT * FROM solution_category1 WHERE id='$category_id' LIMIT 1";
$result2=mysqli_query($dbc,$query2) or die('出错');
$row2=mysqli_fetch_array($result2);
$query3="SELECT * FROM solution_category0 WHERE id='$row2[class0_id]' LIMIT 1";
$result3=mysqli_query($dbc,$query3) or die('出错');
$row3=mysqli_fetch_array($result3);
$query4="SELECT b.*,u.nickname ".
"FROM buy_solution AS b ".
"INNER JOIN user AS u ON(u.id=b.user_id) ".
"WHERE b.solution_id='$id'";
$result4=mysqli_query($dbc,$query4) or die('出错');
$criticism_number=0;
//查看该用户是否购买了该视频
$buyornot=0;
$arr1= array();
while($row4=mysqli_fetch_array($result4)){$arr1[] =$row4;}
foreach($arr1 as $row4){if(!empty($row4['criticism'])){$criticism_number++;}if(isset($_SESSION['session_user_id'])&&$row4['user_id']==$_SESSION['session_user_id']&&$row4['times']<10){$buyornot=1;}}
//查看是不是上传者
if(!empty($_COOKIE[$row['id'].$_SESSION['session_user_id'].'s'])){$buyornot=1;}
if($_SESSION['session_user_id']==$row1['user_id']){$buyornot=1;}
//查看该用户是否购买了该视频
//解决没有购买的视屏无信息的问题
$query5="SELECT e.*,u.nickname,x.picture,x.textbook_information ".
"FROM solution AS e ".
"INNER JOIN user AS u ON(u.id=e.user_id) ".
"INNER JOIN textbook_picture AS x ON(x.id=e.title_picture) ".
"WHERE e.id='$id'";
$result5=mysqli_query($dbc,$query5) or die('出错');
$row=mysqli_fetch_array($result5);
//解决没有购买的视屏无信息的问题
?>
<title><?php echo $row['heading']?>下载-<?php echo $row2['class1'];?>下载-聚峰网</title>
<meta name="description" content="这里有<?php echo $row['heading']?>下载，<?php echo $row2['class1'];?>下载，来自聚峰网，打造最优秀的视频教程分享网站"/>
<meta name="keywords" content="聚峰网,<?php echo $row['heading']?>，<?php echo $row2['class1'];?>"/>
<link type="text/css" rel="stylesheet" href="intro.css"/>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>


<body>
		
<div id="frame">

<?php
require_once("../repeat_code/nav.php")
?>
  <div id="page">
     <div class="intro_container">
       
        <div class="intro_information">
            <div class="intro_details">
                 <div class="intro_details_a1">
                      <p class="de_tittle1"><?php echo $row3['class0'];?></p><p class="de_tittle1">&nbsp;>&nbsp;</p><p class="de_tittle1" ><?php echo $row2['class1']?></p><p class="de_tittle1">&nbsp;>&nbsp;<?php echo $row['heading']?></p>
                      <div class="a1_top">
                         <div class="intro_details_a1_img">
                         <a target="_blank" title="点击查看大图" href="/textbook_picture/<?php echo $row['picture']?>"><img alt="<?php echo $row['heading']?>下载" src="/textbook_picture/<?php echo $row['picture']?>" width="180px" height="227px;" />
                         </a>
                     </div>
                         <div class="a1_top_right">
                              <p id="rmb">评分：</p><p id="rmb_num1"><?php echo $pinfen;?></p>
                              <p id="rmb_num"><?php if($row['price']==0){echo '免';}else{echo $row['price'];}?>学币</p>
                              <div class="intro_details_a1_information">
                                  <ul class="intro_row2">
                                       <li class="intro_row2_1">专题：<a href="video_topics.php?category=<?php echo $category_id?>"><?php echo $row2['class1']?></a></li>
                                       <li class="intro_row2_4">作者：<a  target="_blank" href="/personal_index/personal_show.php?nickname=<?php echo $row['nickname']?>"><?php echo $row['nickname']?></a></li>                                                                                                      <li class="intro_row2_1">学校：<?php if(!empty($row['school'])){echo $row['school'];}else{echo '无';}?></li>
                                       <li class="intro_row2_4">专业：<?php if(!empty($row['subject'])){echo $row['subject'];}else{echo '无';}?></li>
                                       <li class="intro_row2_1">教材版本：<?php if($row['textbook_information']!='*'){$jiaocai=explode("*",$row['textbook_information']);
	echo $jiaocai[0].'—'.$jiaocai[1];}else{echo '无';}?></li>
                                       <li class="intro_row2_4">上传时间：<?php echo substr($row['date'],0,10)?></li>
                                       <li class="intro_row2_1"><?php echo '评论：'.$criticism_number;?></li>
                                       <li class="intro_row2_4"><?php echo '交易量：'.$jiaoyiliang;?></li>

                                  </ul>
                             </div>
                             <div class="intro_play_con">
<?php     
if($row['price']==0)
{echo '<a class="intro_play" href="download.php?id=';echo $id.'";>下载资料</a>';}else        
	{if(!isset($_SESSION['session_user_id']))
	{echo '<a class="intro_play" href="#">付费并下载</a>';echo '<script type="text/javascript"> $(document).ready(function(){ $(".intro_play").click(function() {window.location.href="/login/login.php";});});</script>';}
	else{
			if($buyornot==1)
			{echo '<a class="intro_play" href="download.php?id=';echo $id.'";>下载资料</a>';}
			else
				  {if($_SESSION['session_money']<$row['price'])
				  {echo '<a class="intro_play" href="/personal_index/personal_index.php">充值并下载</a>';}
				  else{
//处理播放次数到期
$querydaoqi="SELECT * FROM buy_solution WHERE solution_id='$id' AND user_id='$_SESSION[session_user_id]' AND times='10' LIMIT 1";
	$resultdaoqi=mysqli_query($dbc,$querydaoqi) or die('出错');
	$daoqi=mysqli_num_rows($resultdaoqi);
	if($daoqi==1){echo '<a class="intro_play daoqi" href="#";>付费并下载</a>';}else{ echo '<a class="intro_play" href="download.php?id=';echo $id.'";>付费并下载</a>';}
//处理播放次数到期结束	  
					  
					 }
			}
	}
}
							 ?>
                             </div>
                         </div>
                      </div>
                     
                 </div>
                 <div class="intro_details_a2">
                       <div class="tabContainer">
                          <ul id="tabHeader">
                              <li>详细介绍</li> 
                              <li>评价详情</li>
                              <li>成交记录</li>
                          </ul>
                          <div id="contents">
                              <div class="tabContent">
                  <div class="jianjie_con">
                    <p class="jieshao_zi">内容介绍</p>
                  </div>
                  <!--end jianjie_con-->
                  <p class="jieshao_neirong"><?php echo $row['summary']?></p>
                 
                  
                  
                                     <div class="jianjie_con">
                      <p class="jieshao_zi">截图</p>
                    </div>
                    <div class="jietu"> 
                       
<?php if(!empty($row['upload_picture1'])){?><img alt="<?php echo $row['heading']?>视频教程" src="keys/<?php echo $row['upload_picture1']?>" width="700px"/><br /><br /><?php }?>
<?php if(!empty($row['upload_picture2'])){?><img alt="<?php echo $row['heading']?>视频教程" src="keys/<?php echo $row['upload_picture2']?>" width="700px"/><br /><br /><?php }?>
<?php if(!empty($row['upload_picture3'])){?><img alt="<?php echo $row['heading']?>视频教程" src="keys/<?php echo $row['upload_picture3']?>" width="700px"/><br /><br /><?php }?>
<?php if(!empty($row['upload_picture4'])){?><img alt="<?php echo $row['heading']?>视频教程" src="keys/<?php echo $row['upload_picture4']?>" width="700px"/><br /><br /><?php }?>
<?php if(!empty($row['upload_picture5'])){?><img alt="<?php echo $row['heading']?>视频教程" src="keys/<?php echo $row['upload_picture5']?>" width="700px"/><br /><br /><?php }?>
                     
                    <!--end jianjie_con--> 
                    
                  </div>
                 
                </div>
                              <div class="tabContent">
<div class="comment_container">
<div class="comment_tittle">                                  
<?php     
$i=0;                            
foreach($arr as $row){if(!empty($row['grade'])){$i++;}}
?>
<p>评价总数：共<?php echo $i?>条</p>
</div>
<div class="comment_content">
<?php                               
foreach($arr as $row){if(!empty($row['grade'])){
?>                                  
 <div class="comment">
   <div class="comment_infor">
     <div class="comment_left">
        <p class="comment_a"><?php echo $row['nickname']?></p>
        <p class="comment_b"><?php echo $row['criticism_date']?></p>
     </div>
     <div class="comment_right">
         <p><?php echo $row['grade']?>分</p>
     </div>
   </div> 
   <div class="comment_details"><?php echo $row['criticism']?></div>
 </div>                                       
<?php }}?></div></div></div>
                              <div class="tabContent">
                              <div class="comment_container">
<div class="comment_tittle">                                  
<?php     
$i=0;                            
foreach($arr as $row){$i++;}
?>
<p>交易总数：共<?php echo $i?>条</p>
</div>
<div class="comment_content">
<?php                               
foreach($arr as $row){
?>                                  
 <div class="comment1">
   <div class="comment_infor">
     <div class="comment_left">
        <p class="comment_a"><?php echo $row['nickname']?></p>
        <p class="comment_b"><?php echo $row['criticism_date']?></p>
     </div>
   </div> 
 </div>                                       
<?php }?>
                              </div></div></div>
                          </div>
                      </div>
                      <script type="text/javascript">
			$(document).ready(function ()
			{
				$('.tabContent:gt(0)').hide();
				$('#tabHeader > li:eq(0)').addClass('active');
				$('#tabHeader > li').click(showHideTabs);
				$('#addTab').click(addTab);				

				function showHideTabs()
				{
					var allLi = $('#tabHeader > li').removeClass('active');
					$(this).addClass('active');
					var index = allLi.index(this);
					$('.tabContent:visible').hide();
					$('.tabContent:eq('+index+')').show();
				}
			});
		</script>
<script type="text/javascript">
$('.daoqi').bind
	('click',function()
	{    if(confirm("您的下载次数已到达十次，您想要重新购买吗？"))
		{window.location.href="/key/download.php?id=<?php echo $id?>";
         }
});
</script>
                 </div>
            </div>
          <div class="intro_ads">
             <p class="ads_tittle">相关推荐</p>
        <a href="/examination/intro.php?id=9"><img src="/image/catia2.png" title="机械设计课程设计 第一集：方法介绍及CATIA模型下载" alt="<?php echo $row['heading']?>视频教学" width="100%" height="380px"></a>
       <a href="/examination/intro.php?id=10"> <img src="/image/catia3.png"  title="机械设计课程设计 第二集：模型的参数调节 装配 工程图（上" alt="<?php echo $row['heading']?>视频教学" width="100%" height="380px"></a>
        <a href="/examination/intro.php?id=14"><img src="/image/catia5.png"  title="机械设计课程设计-第三集：快速完成CAD的方法" alt="<?php echo $row['heading']?>视频教学" width="100%" height="380px"></a>
        
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