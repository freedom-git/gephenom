<?php //更新钱数  
$query250="SELECT * FROM user WHERE id='$_SESSION[session_user_id]' LIMIT 1";
$result250 = mysqli_query($dbc,$query250) or die('查询数据库错误1');
$row250=mysqli_fetch_array($result250);
$_SESSION['session_money']=$row250['money'];
//更新结束?>
<div class="navContainer">
       <div class="logo">
          <div class="logo_container">
               <a href="/index.php"><img alt="聚峰网" src="/image/LOGO.gif" height="70" width="160" /></a>
          </div>
          <div class="denglu_container">
               <?php
if(isset($_SESSION['session_user_id'])){?><li id="kehuxinxi"><a href="/personal_index/personal_index.php"><?php echo '昵称：'.$_SESSION['session_nickname'].'<br /><br />'.'余额：'.$_SESSION['session_money'].' 学币';?></a></li><?php }
else
{?><li id="dengLu"><a href="/login/login.php">登录</a></li><li class="zhuce"><a href="/login/sign_in.php">注册</a></li><?php }
?>
          </div>
       </div>
       <div id="nav">
           <ul class="nav_con">
              <li><a href="/index.php">首页</a></li>
              <li><a href="/help/display.php?id=1">新手上路</a></li>
              <li><a href="/tutorial/tutorial_topics.php">软件教程</a></li>
              <li><a href="/examination/examination_topics.php">大学课程</a></li>
              <li><a href="/key/key_topics.php">学习资料</a></li>
              <li><a href="/personal_index/personal_index.php">个人中心</a></li>
             <a href="/upload_select.php"> <li class="upload">
                  <p>我要上传</p>
              </li></a>
           </ul>
       </div>     
</div>

