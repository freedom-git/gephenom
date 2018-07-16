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
if(isset($_GET['person'])){$person=mysqli_real_escape_string($dbc,trim($_GET['person']));}else{$person=$_SESSION['session_user_id'];}
if(isset($_GET['search'])){$serch_text=mysqli_real_escape_string($dbc,trim($_GET['search']));}//搜索
$search_query="select * ".
"from examination ".
"WHERE user_id='$person'";
if(isset($_GET['person'])){$search_query.=" AND pass>0";}
if(!empty($serch_text)){
$search_query.=deal($serch_text,"heading","AND","AND");
}
$search_query.=" ORDER BY date DESC";
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
$i=0;
while($row=mysqli_fetch_array($result)) {$i++;$_SESSION['i']++;
$query0="SELECT * FROM buy_examination WHERE examination_id='$row[id]'";
$result0=mysqli_query($dbc,$query0) or die('错误');
$jiaoyiliang=mysqli_num_rows($result0);
$pinlunshu=0;
$pinfen=0;
while($row0=mysqli_fetch_array($result0)){
	if(!empty($row0['grade'])){
		$pinlunshu++;
		$pinfen+=$row0['grade'];
		}
	}
?>
<div class="video_infor_container">
         <div class="infor_content">
              <div class="infor_mingzi infor_con">
                  <p><?php if($row['pass']>0){echo '<a target="_blank" href="/examination/intro.php?id='.$row['id'].'" class="font_1a">'.$row['heading'].'</a>';
					  }else{
						  echo $row['heading'];
						  }
					  ?></p>
                  <p class="font_1">交易号：<?php echo $row['id']?></p>
                  <p class="font_1">上传于：<?php echo $row['date']?></p>
              </div>   <!--infor_mingzi-->
              <div class="infor_zhuanti infor_con">
                  <p><a target="_blank" href="/examination/one.php?category=<?php echo $row['category']?>" class="font_2a"><?php
$query1="SELECT * FROM examination_category1 WHERE id='$row[category]' LIMIT 1";
$result1=mysqli_query($dbc,$query1) or die('出错');
$row1=mysqli_fetch_array($result1);
	   echo $row1['class1']?></a></p>
              </div>   <!--infor_zhuanti-->
              <div class="infor_zuozhe infor_con">
                  <p><?php if($row['price']==0){echo '免费';}else{echo $row['price'].'学币';}?></p>
              </div>   <!--infor_zuozhe-->
              <div class="infor_jiage infor_con">
                  <p><?php echo $jiaoyiliang?></p>
              </div>   <!--infor_jiage-->
              <div class="infor_shijian infor_con">
                  <p><?php 
if($row['pass']==0){echo '审核中';}
if($row['pass']==-1){echo '未通过';}
if($pinlunshu==0&&$row['pass']>0){echo 暂无;}
if($pinlunshu!=0&&$row['pass']>0){echo sprintf("%.2f",$pinfen/=$pinlunshu);}?></p>
              </div>   <!--infor_shijian-->
         
   </div>   <!--infor_content-->
	 </div>   <!--video_infor_container-->
     
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
