<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
 ?>
<?php
if(isset($_SESSION['data_mark'])){//可执行开始
$data_mark=$_SESSION['data_mark'];
if(!empty($_GET['search'])){$serch_text=mysqli_real_escape_string($dbc,trim($_GET['search']));}//搜索
$search_query="select * from trade WHERE user_id=$_SESSION[session_user_id]";
if($serch_text==2){$search_query.=" AND type='1' OR user_id=$_SESSION[session_user_id] AND type='2'";}
$search_query.=" ORDER BY time DESC";
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询出错');
$i=0;
while($row=mysqli_fetch_array($result)) {$i++;$_SESSION['i']++;
if($row['type']!=1&&$row['type']!=2){
	if($row['type']==3||$row['type']==4){$database='tutorial';}
	if($row['type']==5||$row['type']==6){$database='examination';}
	if($row['type']==7||$row['type']==8){$database='solution';}
$search1="select * from $database WHERE id='$row[trade_no]'";
$result1=mysqli_query($dbc,$search1)or die('查询出错');
$row1=mysqli_fetch_array($result1);
	if($row['type']==8||$row['type']==4||$row['type']==6){
	$search2="select * from user WHERE id='$row1[user_id]'";
	$result2=mysqli_query($dbc,$search2)or die('查询出错');
	$row2=mysqli_fetch_array($result2);
	}
	if($row['type']==3||$row['type']==5||$row['type']==7){
	$search2="select * from user WHERE id='$row[buyer]'";
	$result2=mysqli_query($dbc,$search2)or die('查询出错');
	$row2=mysqli_fetch_array($result2);
	}
}
?>
<div class="video_infor_container">
  <div class="infor_content">
    <div class="infor_mingzi infor_con">
      <p><a target="_blank" href="<?php if($row['type']==1||$row['type']==2){echo '/';}
	                                    if($row['type']==3||$row['type']==4){echo '/tutorial/intro.php?id='.$row1['id'].'';}
										if($row['type']==5||$row['type']==6){echo '/examination/intro.php?id='.$row1['id'].'';}
										if($row['type']==7||$row['type']==8){echo '/key/intro.php?id='.$row1['id'].'';}
	  ?>" class="font_1a"><?php if($row['type']==1){echo '聚峰网充值';}
	                            if($row['type']==2){echo '聚峰网提现';}
								if($row['type']!=1&&$row['type']!=2){echo $row1['heading'];}
	  ?></a></p>
      <p class="font_1"><?php if($row['type']==1||$row['type']==2){echo '交易号：'.$row

['trade_no'];}else{echo '收支号：'.$row['id'];}?></p>
      <p class="font_1">交易于：<?php echo $row['time']?></p>
    </div>
    <!--infor_mingzi-->
    <div class="infor_zhuanti infor_con">
      <p><?php
	   if($row['type']==1){echo '充值';}
	   if($row['type']==2){echo '提现';}
	   if($row['type']==3||$row['type']==5||$row['type']==7){echo '售出';}
	   if($row['type']==4||$row['type']==6||$row['type']==8){echo '购买';}
	   ?></p>
    </div>
    <!--infor_zhuanti-->
    <div class="infor_zuozhe infor_con">
      <p><a target="_blank" href="<?php if($row['type']==1||$row['type']==2){echo '/';}else{echo '/personal_index/personal_show.php?nickname='.$row2['nickname'];}?>" class="font_2a"><?php if($row['type']==1||$row['type']==2){echo '聚峰网';}else{echo $row2['nickname'];}?></a></p>
    </div>
    <!--infor_zuozhe-->
    <div class="infor_jiage infor_con">
      <p <?php if($row['type']==1||$row['type']==3||$row['type']==5||$row['type']==7){echo 'class="lvse"';}else{echo 'class="huangse"';}?>><?php if($row['type']==1||$row['type']==3||$row['type']==5||$row['type']==7){echo '+';}else{echo '-';}?><?php echo $row['how_much']?></p>
    </div>
    <!--infor_jiage--> 
    <div class="infor_shijian infor_con">
        <p><?php echo $row['balance'];?></p>
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