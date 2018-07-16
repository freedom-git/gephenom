<?php
require_once("../phpmailer/class.phpmailer.php");//包含email发送文
require_once("../repeat_code/head.php");
?>
<?php
if(isset($_GET['id'])){$id=$_GET['id'];}else{exit;}
//查询视频信息
$query="SELECT * FROM examination WHERE id='$id' LIMIT 1";
$result=mysqli_query($dbc,$query) or die('出错');
$row=mysqli_fetch_array($result);
if($row['pass']<=0){exit;}//防止观看未通过审核
if($row['price']!=0)//付费开始
{require_once("../repeat_code/member.php");
$query0="SELECT * FROM buy_examination WHERE examination_id='$id' AND user_id='$_SESSION[session_user_id]' AND times<'10' LIMIT 1";
$result0=mysqli_query($dbc,$query0) or die('出错');
$buyornot=mysqli_num_rows($result0);
$row0=mysqli_fetch_array($result0);
if(isset($_POST['submit'])||!empty($_COOKIE[$row['id'].$_SESSION['session_user_id'].'e'])){$buyornot=1;}
if($_SESSION['session_user_id']==$row['user_id']){$buyornot=1;}
if($buyornot==0){if($_SESSION['session_money']<$row['price']){echo '<script type="text/javascript">alert("余额不足，请充值");window.location.href="/personal_index/personal_index.php";</script>';exit;}else{ 
//插入购买信息并划分钱款
      $query4="insert into buy_examination (user_id,examination_id) values ('$_SESSION[session_user_id]','$id')";//插入购买信息
      $result4 = mysqli_query($dbc,$query4) or die('插入数据库错误');
	  
	  $balance1=$_SESSION['session_money']-$row['price'];//计算购买用户余额
	  
	  $query6="SELECT * FROM user WHERE id='$row[user_id]' LIMIT 1";//查询上传用户id
      $result6=mysqli_query($dbc,$query6) or die('出错');
      $row6=mysqli_fetch_array($result6);
	  
	  $balance2=$row6['money']+$row['price']/2;//计算上传用户余额
	  
	  $query5="UPDATE user SET money='$balance1' WHERE id='$_SESSION[session_user_id]' LIMIT 1";//写入购买用户余额
      $result5=mysqli_query($dbc,$query5) or die('错误1');
	  
	  $query7="UPDATE user SET money='$balance2' WHERE id='$row[user_id]' LIMIT 1";//写入上传用户余额
      $result7=mysqli_query($dbc,$query7) or die('错误2');
	  
	  $query_trade1="insert into trade (user_id,how_much,trade_no,balance,type) values ('$_SESSION[session_user_id]','$row[price]','$id','$balance1','6')";//写入购买用户余额
      $result_trade1=mysqli_query($dbc,$query_trade1) or die('错误1');
	  $how_much=$row['price']/2;
	  $query_trade2="insert into trade (user_id,how_much,trade_no,balance,type,buyer) values ('$row[user_id]','$how_much','$id','$balance2','5','$_SESSION[session_user_id]')";//写入上传用户余额
      $result_trade2=mysqli_query($dbc,$query_trade2) or die('错误2');
	  
	  $money_daru=sprintf("%.2f", $row['price']/2);
	  $xinxi='购买成功，您获得了十次学习机会，每次学习的时间为两小时，上传者'.$row6['nickname'].'赚到了'.$money_daru.'学币。';
	 // mail($row[email]$_SESSION['session_nickname'])
	  ?>
	  <script type="text/javascript">alert("<?php echo $xinxi?>");</script>;
  <?Php
  //开始发信息
$address="$row6[email]";
$body ="尊敬的“".$row6['nickname']."”您好，用户“".$_SESSION['session_nickname']."”刚刚购买了您上传的”".$row['heading']."“，聚峰网已将".$money_daru."学币划入您的账户中，您可以登录个人中心查看。";
$mail = new PHPMailer(); //建立邮件发送类
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->CharSet='utf-8';// 设置邮件的字符编码
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = 'gephenom@163.com'; // 邮局用户名(请填写完整的email地址)
$mail->Password = "ZhangZhi220807"; // 邮局密码
$mail->From = "gephenom@163.com"; //邮件发送者email地址
$mail->FromName = '聚峰网';
$mail->AddAddress("$address","$row6[nickname]");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject ="交易反馈";  //邮件标题
$mail->Body ="$body"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$email_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
echo $ok= "邮件发送失败";
}else{$ok= "邮件发送成功";}
  }	//付费结束
//插入购买信息并划分钱款
	}}
//写入评分
if(isset($_POST['submit'])){
$grade=mysqli_real_escape_string($dbc,trim($_POST['pf']));
$criticism=mysqli_real_escape_string($dbc,trim($_POST['criticism']));
if(empty($grade)||empty($criticism)){echo '<script type="text/javascript">
history.go(-1);
alert("请将信息填写完整");
</script>';exit;}
$query22="UPDATE buy_examination SET grade='$grade',criticism='$criticism',criticism_date=now() WHERE examination_id='$id' AND user_id='$_SESSION[session_user_id]'  AND times<'10' LIMIT 1";
$result22=mysqli_query($dbc,$query22) or die('错误');
 $xinxi0='评分成功，您为该视频评分为'.$grade.'分';
	  ?>
	  <script type="text/javascript">alert("<?php echo $xinxi0?>");</script>;
	  <?Php
	}
//写入评分
$query1="SELECT * FROM buy_examination WHERE examination_id='$id' AND user_id='$_SESSION[session_user_id]' AND times<='10' LIMIT 1";
$result1=mysqli_query($dbc,$query1) or die('出错');
$row1=mysqli_fetch_array($result1);


$category_id=$row['category'];
$query2="SELECT * FROM examination_category1 WHERE id='$category_id' LIMIT 1";
$result2=mysqli_query($dbc,$query2) or die('出错');
$row2=mysqli_fetch_array($result2);
$query3="SELECT * FROM examination_category0 WHERE id='$row2[class0_id]' LIMIT 1";
$result3=mysqli_query($dbc,$query3) or die('出错');
$row3=mysqli_fetch_array($result3);
//查询视频信息
?>
<title>正在播放：<?php echo $row['heading'];?></title>
<link type="text/css" rel="stylesheet" href="display.css"/>
<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="/js/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="shz48gSRhfyGvIey3IGQlPh9RBxf2y7HPX3uHQ==";</script>                     
</head>
<?php
//控制播放次数
if(!isset($_POST['submit'])&&empty($_COOKIE[$row['id'].$_SESSION['session_user_id'].'e'])){
$times=$row0['times']+1;
$queryadd1="UPDATE buy_examination SET times='$times' WHERE examination_id='$id' AND user_id='$_SESSION[session_user_id]' AND times<'10' LIMIT 1";
$resultadd1=mysqli_query($dbc,$queryadd1) or die('错误');
setcookie($row['id'].$_SESSION['session_user_id'].'e','times',time()+7200);
}
?>
<html>
<body>
<?php
require_once("../repeat_code/nav.php");
$url=$row['video'];
?>
<div id="frame">


   
  <div id="page">
        <div class="display_container">
            <div class="display_information">
             <h4 class="class"><?php echo $row3['class0'];?> > <?php echo $row2['class1']?></h4>
<?php if($row['price']==0){echo '<!--';}?><h4 class="times">第<?php if(isset($times)){echo $times;}else{if(!empty($row0['times'])){echo $row0['times'];}else{echo '10';} ;}?>次播放</h4><?php if($row['price']==0){echo '-->';}?>
            <div id="title"><h1><?php echo $row['heading'];?></h1></div>
            </div>
           
            <?php
			if($row['price']!=0){//付费视频开始
            if(strtolower(substr(strrchr($url,"."),1))=='flv'){
				?>
             <div id="player">
           
             <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="800" height="600">
		<param name="movie" value="/examination/examinations/player.swf" />
		<param name="allowfullscreen" value="true" />
		<param name="allowscriptaccess" value="always" />
		<param name="flashvars" value="file=/examination/examinations/<?php echo $url;?>" />
		<embed
			type="application/x-shockwave-flash"
			id="player2"
			name="player2"
			src="/examination/examinations/player.swf" 
			width="800" 
			height="600"
			allowscriptaccess="always" 
			allowfullscreen="true"
			flashvars="file=/examination/examinations/<?php echo $url;?>" 
		/>
        
	</object>
			 </div> 
          
          <?php
			}
			if(strtolower(substr(strrchr($url,"."),1))=='swf'){
				?>
                 <div id="display_container_show">
        <EMBED src="/examination/examinations/<?php echo $url;?>" allowfullscreen="true" quality=high bgcolor="#000000"  WIDTH=800 HEIGHT=628 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" flashvars="specialcode=www.gephenom.com"></EMBED>
                </div>        
     
                
              <!--  <script type="text/javascript"> 
                   swfobject.embedSWF("/tutorial/tutorials/<?php echo $url;?>", "display_container_show", "800", "600", "9.0.0","expressInstall.swf");
				  
                </script> --> 
                <?php
			}
			}//付费视频结束
			else//免费视屏开始
				{?>
				<div id="youkuplayer" style="width:800px;height:600px"></div>
				<script type="text/javascript" src="http://player.youku.com/jsapi">
                player = new YKU.Player('youkuplayer',{
                styleid: '1',
                client_id: '6eecde5d62a7828d',
                vid: '<?php echo $row['youku_id']?>',
				password: 'gephenom',
				show_related: false,
                autoplay: true,
                events:{
                onPlayerReady: function(){ /*your code*/ },
                onPlayStart: function(){ /*your code*/ },
                onPlayEnd: function(){/*your code*/}
                }
                });
                function playVideo(){
                player.playVideo();
                }
                function pauseVideo(){
                player.pauseVideo();
                }
                function seekTo(s){
                player.seekTo(s);
                }
                function currentTime(){
                return player.currentTime();
                }
                </script>
				<?php
				}//免费视屏结束
				
?>
      
 

<?php if(!empty($row['attachment'])){?><a href="/examination/examinations/<?php echo $row['attachment'];?>"><div class="display_ads">下载附件</div></a>
<?php }?>

           
           <div class="display_comment">

<?php
//评价
if(empty($row1['grade'])&&$_SESSION['session_user_id']!=$row['user_id']&&$row['price']!=0){
	?>
               <div class="display_comment_tittle">
                   <p>添加评价</p>
               </div>
               <form action="<?php echo $_SERVER['php_self']?>" method="post">
               <div class="display_comment_container">
                    <div class="comment_score">
                        评分：
                        
                        <input type="radio" name="pf" value="1" /> 1分
                        <input type="radio" name="pf" value="2" /> 2分
                        <input type="radio" name="pf" value="3" /> 3分
                        <input type="radio" name="pf" value="4" /> 4分
                        <input type="radio" name="pf" value="5" /> 5分
                        <input type="radio" name="pf" value="6" /> 6分
                        <input type="radio" name="pf" value="7" /> 7分
                        <input type="radio" name="pf" value="8" /> 8分
                        <input type="radio" name="pf" value="9" /> 9分
                        <input type="radio" name="pf" value="10" /> 10分
                    </div>
                    <textarea value="<?php echo $criticism?>" name="criticism" class="comment_area"></textarea>
                    <input name="submit" type="submit" class="comment_submit" value="提交评价">
               </div>
               </form>
               
<?php 
}else{
	if($_SESSION['session_user_id']!=$row['user_id']&&$row['price']!=0){
	?>
               <div class="display_comment_tittle">
                   <p>已经评价</p>
               </div>
               <div class="display_comment_container">
                    <div class="comment_score">
                       您的评分为：<?php echo $row1['grade'];?>分
                    </div>
                    <div class="criticism">
   您的评价为：<br /><br />  <?php echo $row1['criticism'];?>   
                    </div>   
               </div>
		<?php	   	
	}
	else{if($row['price']!=0){	?>
               <div class="display_comment_tittle">
                   <p>您不能对自己的教程进行评价</p>
               </div>
		<?php }
		if($row['price']==0){	?>
               <div class="display_comment_tittle">
                   <p>免费视频无法评价</p>
               </div>
		<?php }
		}}
?>            
               
               
           </div>
       </div>
  </div>
</div>
<?php 
require_once("../repeat_code/footer.php");
?>
</body>
</html>