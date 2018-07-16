<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
	
require_once("../repeat_code/function.php");//
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
 ?>

<div class="buy_video">
    <p class="buy_video_tittle">我发布的任务</p>
	<div class="buy_video_search">
        <p class="search_p">交易搜索：</p>
        <div class="search_container">
            <input type="text" class="search_box" id="" />
            <button type="button" class="button_12">搜索</button>
        </div>
    </div>
    <p class="search_res1 res_left">共搜索到:</p><p class="search_res2">10</p><p class="search_res1">笔交易记录</p>
    <ul class="buy_video_ul">
        <li class="video_li video_1">标题</li>
        <li class="video_li video_2">类别</li>
        <li class="video_li video_3">截止期限</li>
        <li class="video_li video_4">赏金</li>
        <li class="video_li video_5">状态</li>
        <li class="video_li video_6">消息</li>
    </ul>
    <div class="video_infor_container">
         <div class="infor_content">
              <div class="infor_mingzi infor_con">
                  <p><a href="#" class="font_1a">沙发上发家史的护肤静安寺多了几分啊结婚前集</a></p>
                  <p class="font_1">交易号：2345234534</p>
                  <p class="font_1">发布于：2013-10-12 23:24:04</p>
              </div>   <!--infor_mingzi-->
              <div class="infor_zhuanti infor_con">
                  <p><a href="#" class="font_2a">一对多</a></p>
              </div>   <!--infor_zhuanti-->
              <div class="infor_zuozhe infor_con">
                  <p><a href="#" class="font_2a">2013-10-12 23:24:04</a></p>
              </div>   <!--infor_zuozhe-->
              <div class="infor_jiage infor_con">
                  <p>15</p>
              </div>   <!--infor_jiage-->
              <div class="infor_shijian infor_con">
                  <p>正在征集作品</p>
              </div>   <!--infor_shijian-->
              <div class="infor_shijian infor_con">
                  <p>暂无</p>
              </div>   <!--infor_shijian-->
         </div>   <!--infor_content-->
    </div>   <!--video_infor_container-->
</div>




<?php

	}
else{echo '该页面不允许直接浏览';}
?>