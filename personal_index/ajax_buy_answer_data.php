<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require_once("../repeat_code/function.php");
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
 ?>
<?php
if(isset($_SESSION['data_mark'])){//可执行开始
$data_mark=$_SESSION['data_mark'];
if(isset($_GET['search'])){$serch_text=mysqli_real_escape_string($dbc,trim($_GET['search']));}//搜索
$search_query="select b.times,b.id,b.buy_time,t.id as tid,t.heading,t.category,t.price,u.nickname ".
"from buy_solution as b ".
"INNER JOIN solution AS t ON(t.id=b.solution_id) ".
"INNER JOIN user AS u ON(u.id=t.user_id) ".
"WHERE b.user_id=$_SESSION[session_user_id]";
if(!empty($serch_text)){
$search_query.=deal($serch_text,"heading","AND","AND");
}
$search_query.=" ORDER BY date DESC";
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
$i=0;
while($row=mysqli_fetch_array($result)) {$i++;$_SESSION['i']++;
?>
<div class="video_infor_container">
  <div class="infor_content">
    <div class="infor_mingzi infor_con">
      <p><a target="_blank" href="/key/intro.php?id=<?php echo $row['tid']?>" class="font_1a"><?php echo $row['heading']?></a></p>
      <p class="font_1">交易号：<?php echo $row['id']?></p>
      <p class="font_1">购买于：<?php echo $row['buy_time']?></p>
    </div>
    <!--infor_mingzi-->
    <div class="infor_zhuanti infor_con">
      <p><a target="_blank" href="/key/one.php?category=<?php echo $row['category']?>" class="font_2a"><?php
$query1="SELECT * FROM solution_category1 WHERE id='$row[category]' LIMIT 1";
$result1=mysqli_query($dbc,$query1) or die('出错');
$row1=mysqli_fetch_array($result1);
	   echo $row1['class1']?></a></p>
    </div>
    <!--infor_zhuanti-->
    <div class="infor_zuozhe infor_con">
      <p><a target="_blank" href="/personal_index/personal_show.php?nickname=<?php echo $row['nickname']?>" class="font_2a"><?php echo $row['nickname']?></a></p>
    </div>
    <!--infor_zuozhe-->
    <div class="infor_jiage infor_con">
      <p><?php if($row['price']==0){echo '免费';}else{echo $row['price'].'学币';}?></p>
    </div>
    <!--infor_jiage--> 
    <div class="infor_shijian infor_con">
        <p><?php echo $row['times'];?></p>
        </div>
  </div>
  <!--infor_shijian--> 
  
</div>
<?php
}
$_SESSION['data_mark']=$_SESSION['data_mark']+12;
if($i!=12){unset($_SESSION['data_mark']);}
//可执行结束
}else{}

?>
<script type="text/javascript">
$('.search_res2').html("<?php echo $_SESSION['i'];?>");
</script>
<?php

	}
else{echo '该页面不允许直接浏览';}
?>
