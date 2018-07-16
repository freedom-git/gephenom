<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/function.php");
if(isset($_SESSION['data_mark'])){//可执行开始
$data_mark=$_SESSION['data_mark'];
$category=$_GET['category'];
if(isset($_GET['search'])){$serch_text=$_GET['search'];}
if(isset($_GET['type'])){$type=$_GET['type'];}
if(isset($_GET['series'])){$series=$_GET['series'];}
if(isset($_GET['sort'])){
$sort=$_GET['sort'];
if($sort==1&&$type!=1){$order='ORDER BY price ASC';}
if($sort==2&&$type!=1){$order='ORDER BY price DESC';}
if($sort==3){$order='ORDER BY date ASC';}
if($sort==4){$order='ORDER BY date DESC';}
}else{$sort=4;$order='ORDER BY date DESC';}
//搜索
if(!isset($_GET['type'])||$_GET['type']!=1){//单个视频开始
if(!empty($series)){
$search_query="select t.*,u.nickname ".
"from tutorial as t ".
"INNER JOIN user AS u ON(u.id=t.user_id) ".
"WHERE series_id='$series' AND pass>'0'";
}else{
$search_query="select t.*,u.nickname ".
"from tutorial as t ".
"INNER JOIN user AS u ON(u.id=t.user_id) ".
"WHERE category='$category' AND pass>'0'";
}
if(!empty($serch_text)){
$search_query.=deal($serch_text,"heading","AND","AND");
}
if(!$order==''){$search_query.=" $order";}
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
$i=0;

while($row=mysqli_fetch_array($result)) {$i++;
//查专辑
if($row['series_id']!=0){
$query_series="SELECT * FROM tutorial_series WHERE id='$row[series_id]' LIMIT 1";
$result_series=mysqli_query($dbc,$query_series) or die('错误');
$row_series=mysqli_fetch_array($result_series);
$series_name=$row_series['series_name'];
$series_id=$row_series['id'];
}else{$series_name='无';}
//查专辑
$query0="SELECT * FROM buy_tutorial WHERE tutorial_id='$row[id]'";
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
      <div class="show_content">
               <img src="/tutorial/tutorials/<?php echo $row['title_picture']?>" alt="<?php echo $row['heading']?>视频教程" width="220" height="140" />
         
         <div class="content_infor">
               <p class="content_mingzi"><a target="_blank" href="intro.php?id=<?php echo urlencode($row['id'])?>"><?php echo $row['heading']?></a></p>
               <div class="content_a">
                  <p class="content_jiage1">价格：</p><p class="content_jiage2"><?php if($row['price']==0){echo '免费';}else{echo $row['price'].'学币';}?></p>
                  <div class="infor_hidden">
                       <p class="content_zuozhe1">作者：</p><p class="content_zuozhe2"><a   target="_blank" href="/personal_index/personal_show.php?nickname=<?php echo $row['nickname']?>"><?php echo $row['nickname']?></a></p>
                       <p class="content_zhuanji">所属专辑：<a  href="/tutorial/video_topics.php?sort=4&category=<?php echo $category?>&type=0&series=<?php echo $series_id?>"><?php echo $series_name?></a></p>
                       <p class="content_shijian">上传时间：<?php echo substr($row['date'],0,10)?></p>
                       <div class="pingfen">
                           <p class="font_pingfen1">评分：</p>
                           <p class="font_pingfen2"><?php if($pinlunshu==0){echo 暂无;}
		  else{echo sprintf("%.2f",$pinfen/=$pinlunshu);}?>&nbsp;(共<?php echo $pinlunshu?>个评论)</p>
                           <p class="font_pingfen1">交易量：</p><p class="font_pingfen2"><?php echo $jiaoyiliang?></p>
                       </div>
                       <a target="_blank" class="infor_play"  href="intro.php?id=<?php echo urlencode($row['id'])?>"><strong>详细介绍</strong></a>
                  </div>
               </div>
          </div>
</div><?php }}//单个视频结束
if($_GET['type']==1){//成套视频开始
//查询套
$arr10=array();
$arr11=array();
$add=0;
$query10="SELECT * FROM tutorial WHERE category='$category' AND pass>'0' AND series_id>'0'";
$result10=mysqli_query($dbc,$query10) or die('错误');
if(mysqli_num_rows($result10)!=0){//有内容，可呈现开始
while($row10=mysqli_fetch_array($result10)){if($row10['series_id']!=0){$arr10[]=$row10['series_id'];}}
foreach($arr10 as $series){//去除重复项
	foreach($arr11 as $compare){if($compare==$series){$add++;}}
	if($add==0){$arr11[]=$series;}
	$add=0;}
//查询套结束
//显示套
$search_query="select t.*,u.nickname ".
"from tutorial_series as t ".
"INNER JOIN user AS u ON(u.id=t.user_id) ".
"WHERE ";
$arr12=array();
if(!empty($serch_text)){
$s=deal($serch_text,"series_name","AND","AND");
}
foreach($arr11 as $series){$arr12[]="t.id=$series.$s";}
$search_query.=implode(" OR ",$arr12);


if(!$order==''){$search_query.=" $order";}
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
$i=0;
while($row=mysqli_fetch_array($result)) {$i++;

	
	
	
?>
      <div class="show_content">
               <img src="/tutorial/tutorials/<?php echo $row['title_picture']?>" alt="<?php echo $row['series_name']?>视屏教程" width="220" height="140" />
         
         <div class="content_infor">
               <p class="content_mingzi"><a href="<?php $url="?sort=4&category=$category&search=$serch_text&type=0&series=$row[id]"; echo $_server['php_self'].$url ?>"><?php echo $row['series_name']?></a></p>
               <div class="content_a">
               <p class="content_jiage1">&nbsp;   </p><p class="content_jiage2">专辑</p>
                  <div class="infor_hidden">
                       <p class="content_zuozhe1">作者：</p><p class="content_zuozhe2"><a   target="_blank" href="/personal_index/personal_show.php?nickname=<?php echo $row['nickname']?>"><?php echo $row['nickname']?></a></p>
                       <p class="content_shijian">上传时间：<?php echo substr($row['date'],0,10)?></p>
                       <div class="pingfen">
                        <!--   <p class="font_pingfen1">评分：</p>
                           <p class="font_pingfen2">个评论)</p>
                           <p class="font_pingfen1">交易量：</p><p class="font_pingfen2"></p>-->
                       </div>
                       <a class="infor_play"  href="<?php $url="?sort=4&category=$category&search=$serch_text&type=0&series=$row[id]"; echo $_server['php_self'].$url ?>"><strong>详细视频</strong></a>
                  </div>
               </div>
          </div>
</div><?php }}else{echo 本专题暂无专辑;}}//有内容，可呈现结束//成套视频结束
//显示套结束

$_SESSION['data_mark']=$_SESSION['data_mark']+12;
if($i!=12){unset($_SESSION['data_mark']);}
//可执行结束
}else{}
?>
<script type="text/javascript">
$(document).ready(function(){
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