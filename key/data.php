<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/function.php");
if(isset($_SESSION['data_mark'])){//可执行开始
$data_mark=$_SESSION['data_mark'];
if(isset($_GET['category'])){
	$category=mysqli_real_escape_string($dbc,trim($_GET['category']));
	}
//区分数据库
if(isset($_GET['search'])){$serch_text=$_GET['search'];}
if(isset($_GET['sort'])){
$sort=$_GET['sort'];
if($sort==1&&$type!=1){$order='ORDER BY price ASC';}
if($sort==2&&$type!=1){$order='ORDER BY price DESC';}
if($sort==3){$order='ORDER BY date ASC';}
if($sort==4){$order='ORDER BY date DESC';}
}else{$sort=4;$order='ORDER BY date DESC';}
//搜索
//开始呈现
$search_query="select t.*,u.nickname,x.picture,x.textbook_information ".
"from solution as t ".
"INNER JOIN user AS u ON(u.id=t.user_id) ".
"INNER JOIN textbook_picture AS x ON(x.id=t.title_picture) ".
"WHERE category='$category' AND pass>'0'";
if(!empty($serch_text)){
$search_query.=deal($serch_text,"heading","AND","AND");
}
if(!$order==''){$search_query.=" $order";}
$search_query.=" limit $data_mark,12";
$result=mysqli_query($dbc,$search_query)or die('查询视频出错');
$i=0;
while($row=mysqli_fetch_array($result)) {$i++;
$query0="SELECT * FROM buy_solution WHERE solution_id='$row[id]'";
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
               <img src="/textbook_picture/<?php echo $row['picture']?>" alt="<?php echo $row['heading']?>下载" width="180" height="227" />
         
         <div class="content_infor">
               <p class="content_mingzi"><a target="_blank" href="intro.php?id=<?php echo urlencode($row['id'])?>"><?php echo $row['heading']?></a></p>
                       <div class="content_a">
                           <p class="content_jiage1">价格：</p><p class="content_jiage2"><?php echo $row['price']?>学币</p>
                   <div class="infor_hidden">
                       <p class="content_zuozhe1">上传者：</p><p class="content_zuozhe2"><a   target="_blank" href="/personal_index/personal_show.php?nickname=<?php echo $row['nickname']?>"><?php echo $row['nickname']?></a></p>
                       <p class="content_shijian">学校：<?php if(!empty($row['school'])){echo $row['school'];}else{echo '无';}?></p>
                       <p class="content_shijian">专业：<?php if(!empty($row['subject'])){echo $row['subject'];}else{echo '无';}?></p>
                       <p class="content_shijian">教材版本：<?php if($row['textbook_information']!='*'){$jiaocai=explode("*",$row['textbook_information']);
	echo mb_substr($jiaocai[0].'—'.$jiaocai[1], 0, 9, 'utf-8').'…';}else{echo '无';}?>
					   </p>
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
</div><?php }

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
         $(this).find(".content_infor").animate({top:"-233px"});
    });
	$(".show_content").mouseleave(function() {
		$(this).find(".content_infor").stop();
		 $(this).find(".content_infor").animate({top:"0"});
    });		
});			
</script>