<?php
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../phpmailer/class.phpmailer.php");//包含email发送文
require_once("../../repeat_code/manage_head.php");
?>
<?php
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($dbc,trim($_GET['id']));
	}else{exit;}


//查询视频信息
$query="SELECT * FROM solution WHERE id='$id' LIMIT 1";
$result=mysqli_query($dbc,$query) or die('出错');
$row=mysqli_fetch_array($result);
$category_id=$row['category'];
$query2="SELECT * FROM solution_category1 WHERE id='$category_id' LIMIT 1";
$result2=mysqli_query($dbc,$query2) or die('出错');
$row2=mysqli_fetch_array($result2);
$query3="SELECT * FROM solution_category0 WHERE id='$row2[class0_id]' LIMIT 1";
$result3=mysqli_query($dbc,$query3) or die('出错');
$row3=mysqli_fetch_array($result3);
//查询视频信息

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>下载：<?php echo $row['heading'];?></title>
<link href="/css/share.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="download.css"/>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="/js/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="shz48gSRhfyGvIey3IGQlPh9RBxf2y7HPX3uHQ==";</script>                     
</head>
<body>

<?php


//写入评分
if(isset($_POST['submit'])){
$grade=mysqli_real_escape_string($dbc,trim($_POST['pf']));
if(empty($grade)){echo '<script type="text/javascript">
history.go(-1);
alert("请将信息填写完整");
</script>';exit;}
$query23="SELECT * FROM user WHERE id='$row[user_id]' LIMIT 1";
$result23=mysqli_query($dbc,$query23) or die('出错');
$row23=mysqli_fetch_array($result23);
if($grade==1){
$query22="UPDATE solution SET pass='$_SESSION[manager_id]' WHERE id='$id' LIMIT 1";
$result22=mysqli_query($dbc,$query22) or die('错误');
 $xinxi0='该资料已通过审核';
 //开始发信息
$address="$row23[email]";
$body ="尊敬的“".$row23['nickname']."”您好，您上传的“".$row['heading']."“已经通过审核，审核员编号为".$_SESSION['manager_id']."号，您可以登录个人中心查看。";
}
if($grade==2){
$criticism=mysqli_real_escape_string($dbc,trim($_POST['criticism']));
if(empty($criticism)){echo '<script type="text/javascript">
history.go(-1);
alert("请填写删除原因");
</script>';exit;}
$query22="UPDATE solution SET pass='-1' WHERE id='$id' LIMIT 1";
$result22=mysqli_query($dbc,$query22) or die('错误');
 $xinxi0='该资料审核已删除';
 //开始发信息
$address="$row23[email]";
$body ="尊敬的“".$row23['nickname']."”您好，您上传的“".$row['heading']."“没有通过审核，审核员编号为".$_SESSION['manager_id']."号。原因反馈：".$criticism."。如有疑问，请使用聚峰网页尾的”意见反馈“提交您的意见。";
}
//发邮件
$mail = new PHPMailer(); //建立邮件发送类
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->CharSet='utf-8';// 设置邮件的字符编码
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = 'gephenom@163.com'; // 邮局用户名(请填写完整的email地址)
$mail->Password = "ZhangZhi220807"; // 邮局密码
$mail->From = "gephenom@163.com"; //邮件发送者email地址
$mail->FromName = '聚峰网';
$mail->AddAddress("$address","$row23[nickname]");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject ="审核通知";  //邮件标题
$mail->Body ="$body"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
echo $ok= "邮件发送失败";
}else{$ok= "邮件发送成功";}
?><script type="text/javascript">alert("<?php echo $xinxi0?>");</script><?php

	}


?>



<?php
require_once("../../repeat_code/nav.php");
$query="SELECT * FROM solution WHERE id='$id' LIMIT 1";
$result=mysqli_query($dbc,$query) or die('出错');
$row=mysqli_fetch_array($result);
$url=$row['video'];
?>
<div id="frame">


   
  <div id="page">
        <div class="display_container">
            <div class="display_information">
             <h4><a href="#"><?php echo $row3['class0'];?></a> > <a href="#"><?php echo $row2['class1']?></a></h4>
            <div id="title"><h1><?php echo $row['heading'];?></h1></div>
            </div>
            <div id="display_container_show">
            </div>

<?php if(!empty($row['video'])){?><a href="/key/keys/<?php echo $row['video'];?>"><div class="display_ads">下载资料</div></a>
<?php }?>

           
           <div class="display_comment">

<?php
//评价
if($row['pass']==0){
	?>
               <div class="display_comment_tittle">
                   <p>审核结果</p>
               </div>
               <form action="<?php echo $_SERVER['php_self']?>" method="post">
               <div class="display_comment_container">
                    <div class="comment_score">
                        <table class="comment_table">选项：</table>
                        
                        <input checked="checked" type="radio" name="pf" value="1" /> 通过&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="pf" value="2" /> 删除
                       
                    </div>
                    <textarea value="<?php echo $criticism?>" name="criticism" class="comment_area"></textarea>
                    <input name="submit" type="submit" class="comment_submit" value="提交审核结果">
               </div>
               </form>
               
<?php 
}
?>  
               
               
           </div>
       </div>
  </div>
</div>
</body>
</html>


<script type="text/javascript">
 $(document).click(function(){
			   $(".score_select_detials").hide();
						});	
</script>
<script type="text/javascript">
                     
					$(document).ready(function ()
			{  
					 	
					$('#submit_to_solution').attr('disabled',true);
	                    var mark1;
	                    var mark2;
	                    var mark3;
	                    var mark4;
	                    var mark5;
	                     $(".score_select_show").click(function(event){
	                     $(".score_select_detials").toggle(); 
	                     event=event||window.event;  
	                     event.stopPropagation();  
	                     $(".sel_item").click(function(){
	                      var sel_text=$(this).text();
	                      $(".score_select_detials").hide();
	                     $("#category").val(sel_text);
	                     $("#score").text(sel_text);
	                     mark1=0;
	                     var cur=$('#category');
	                     cur.next('span').remove();
	                     if(cur.val()=='')
	                     {
	                     $('#submit_to_solution').attr('disabled',true);
	                     cur.after('<span class="error">× 必须选择专题</span>');
	                     	}
	                     else
	                     {
	                     cur.after('<span class="error">√</span>');
	                     mark1=1;
	                     if(mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
	                     $('#submit_to_solution').removeAttr('disabled');
	                         }
	                     }
	                      return false;
	                     	}); 
	                     });
						});	
				
</script>