<?php
require_once("../repeat_code/changliang.php");//包含常量文件
require("../phpmailer/class.phpmailer.php");//包含email发送文
require_once("../repeat_code/head.php");
?>
<title>注册</title>
<script src="/js/slider.js"></script>
<script src="sign_in.js"></script>
<script src="sign_in_back.js"></script>
<script src="/js/ie.js"></script>
<link type="text/css" rel="stylesheet" href="sign_in.css" />
<link href="../css/share.css" rel="stylesheet" type="text/css" />
</head>
<?php
//定义标记
$mark=1;
//获取表单数据
//判断账号是手机号还是邮箱号
if (preg_match('/^\d{11}$/',$_POST['account'])){$phone_number = mysqli_real_escape_string($dbc,trim($_POST['account']));}
if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/',$_POST['account'])){
//unix上可用，用来验证邮箱
/*$domain=preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/','',$email);	if(checkdnsrr($domain)){*/$email=mysqli_real_escape_string($dbc,trim($_POST['account']));/*}*/
}
if((!isset($phone_number))&&(!isset($email))&&(isset($_POST['sign_in_submit']))){$mark=0;echo '<script type="text/javascript">
alert("请输入正确的手机号码或邮箱地址");
</script>';}

$nickname=mysqli_real_escape_string($dbc,trim($_POST['nickname']));
$password=mysqli_real_escape_string($dbc,trim($_POST['password']));
$repeat=mysqli_real_escape_string($dbc,trim($_POST['repeat']));
$email_check_number=mysqli_real_escape_string($dbc,trim($_POST['email_check_number']));
//获取表单数据结束
//确定昵称不重复注册
$query2="select * from user where nickname='$nickname'";
$result2=mysqli_query($dbc,$query2)or die('查询昵称出错');
if (mysqli_fetch_array($result2)){$mark=0;echo '<script type="text/javascript">
alert("该昵称已被注册");
</script>';}
//昵称可用验证
else{
	if(!empty($nickname)&&isset($_POST['form_nickname_check'])&&!isset($_POST['sign_in_submit']))
	{$ok=该昵称可用;}
	}
if(strlen($nickname)>15){$mark=0;echo '<script type="text/javascript">
alert("昵称不能超过十5个字符，五个汉字");
</script>';}

if(empty($nickname)&&(isset($_POST['sign_in_submit']))){$mark=0;echo '<script type="text/javascript">
alert("请输入昵称");
</script>';}
//昵称验证结束

//如果是邮箱
if(isset($email)){//如果是邮箱开始

//检查是否获得验证码后更改账号
if(!($_SESSION['session_email']==$email)){$_SESSION['session_email']=$email;unset($_SESSION['sign_in_email_check']);}





//确定邮箱地址不重复注册
$query1="select * from user where email='$email'";
$result1=mysqli_query($dbc,$query1)or die('查询邮箱地址号码出错');
if (mysqli_fetch_array($result1)){$mark=0;echo '<script type="text/javascript">
alert("该邮箱地址已被注册，如果您忘记了密码，请点击找回密码");
</script>';}
if($_SESSION['sign_in_email_check']=='checked'&&!isset($_POST['check_number'])&&!isset($_POST['sign_in_submit'])){$ok= "邮件已经发送过了，不能重复发送";}
//用来发送邮箱验证邮件
	if($mark==1&&!$_SESSION['sign_in_email_check']=='checked'){
$_SESSION['$send_email_check_number']=rand(10000,99999);
$mail = new PHPMailer(); //建立邮件发送类
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->CharSet='utf-8';// 设置邮件的字符编码
$mail->Host = "smtp.163.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = 'gephenom@163.com'; // 邮局用户名(请填写完整的email地址)
$mail->Password = "ZhangZhi220807"; // 邮局密码
$mail->From = "gephenom@163.com"; //邮件发送者email地址
$mail->FromName = '聚峰网';
$mail->AddAddress("$email","$nickname");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject ='聚峰网注册';  //邮件标题
$mail->Body ="你好，".$nickname."欢迎您加入聚峰网，您的验证码为:".$_SESSION['$send_email_check_number'].".感谢您对我们的支持，我们会竭诚为您服务。"; //邮件内容
$mail->AltBody = "附加信息，可以省略"; //附加信息，可以省略
if(!$mail->Send())
{
/*$email_message= "邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo;*/
echo '<script type="text/javascript">
alert("邮件发送失败. <p>"."错误原因: " . $mail->ErrorInfo);
</script>';
}else{$ok= "邮件发送成功";$_SESSION['sign_in_email_check']='checked';}
}

//表单验证
if ($password!=$repeat){$mark=0;echo '<script type="text/javascript">
alert("两次输入的密码不同，请重新输入");
</script>';}
if (!preg_match('/^\w{6,20}$/',$password)&&!empty($password)){$mark=0;echo '<script type="text/javascript">
alert("密码为6到20个字母或数字组成（区分大小写）");
</script>';}
if (empty($password)){$mark=0;echo '<script type="text/javascript">
alert("请输入密码");
</script>';}

//检查验证码
if(empty($email_check_number)){$mark=0;echo '<script type="text/javascript">
alert("请输入验证码");
</script>';}else{
if(!($_SESSION['$send_email_check_number']==$email_check_number)){$mark=0;echo '<script type="text/javascript">
alert("验证码错误");
</script>';}else{$ok='验证码正确';}}




//写入数据库
if ($mark==1&&$_SESSION['sign_in_email_check']=='checked')
{
$query="insert into user (email,nickname,password) values ('$email','$nickname',SHA1('$password'))";
$result = mysqli_query($dbc,$query) or die('查询数据库错误1');
//自动登录
$query3="SELECT * FROM $yonghuzhucebiao WHERE nickname='$nickname'";
$result3=mysqli_query($dbc,$query3) or die ('登录数据库出错2');
$row=mysqli_fetch_array($result3);
$_SESSION['session_nickname']=$row['nickname'];
$_SESSION['session_user_id']=$row['id'];
$_SESSION['session_money']=$row['money'];
//删除过程会话
unset($_SESSION['login_email_check']);
unset($_SESSION['send_email_check_number']);
unset($_SESSION['session_email']);


echo '<script type="text/javascript">
history.go(-2);
alert("注册成功");
</script>';

$ok=注册成功;
}


}//如果是邮箱结束
?>




<body>

<div id="page">

<?php
require_once("../repeat_code/nav.php");
?>

   
  <div class="page">
  <form action="<?php echo $_server['php_self'];?>" method="post"> 
        
     <div class="firstStep">
   
      <div class="main_container_left"> 
       <div class="tittle_container1">
            <p class="tittle_right">填写注册信息</p>
            </div>
       <div class="main">
        
         <div class="rowText row">
         
           <p id="biaoQian">昵称*</p>
          
                    <input value="<?php echo $nickname;?>" type="text" class="signinInputText" id="nickname" name="nickname" />
                    
          
                  </div>
                  <div class="usernameSumit">
                    
        <!--            <input type="submit" name="form_nickname_check" id="form_nickname_check" class="signinInputSubmit" value="检 查 可 用" />-->
                    
                  </div>
  
       </div>
  
       <div class="main">
         <div class="rowText row">
           <p id="biaoQian">邮箱*</p>
           
                    <input type="text" value="<?php echo $_POST['account'];?>" class="signinInputText" id="account" name="account" />
  
                  </div>
                
       </div>

       <div class="main">
         <div class="rowText row">
           <p id="biaoQian">验证码*</p>
           
                    <input type="text" value="<?php echo $email_check_number;?>" class="signinInputText1" id="email_check_number" name="email_check_number" />
          
          
           <div class="usernameSumit">
                    
                    <input type="button" name="form_email_check" id="form_email_check" class="signinInputSubmit" value="获取验证码" />
                   
                  </div>
              
              </div>     
                  
                  <div class="usernameSumit">
                    
               <!--     <input type="submit" class="signinInputSubmit" id="check_number" name="check_number" value="提交验证码" />-->
                   
                  </div>
       
       </div>

      <div class="main"> 
       <div class="pwd">
         <div class="pwdLeft row"> 
         <p id="biaoQian">密码*</p>
        
                    <input type="password" id="password1" name="password" class="signinInputText" />
       
         </div>
         <div class="pwdRight row">
         <p id="biaoQian">确认密码*</p>
         
                    <input type="password" id="repeat" name="repeat" class="signinInputText" />
     

         </div>  
       </div>
      
      <!--<a id="tiaokuan" href="#">阅读条款</a>-->
      
      
      </div> 
      <div class="pwdSubmit">
                   
                    <input id="sign_in_submit" name="sign_in_submit" type="submit" class="signinInputSubmit" value="同意条款并提交" />
                   
                    
     </div>
      </div><!--end_main_container_left-->
      
      <div class="main_container_right">
            <div class="tittle_container">
            <p class="tittle_right">要求</p>
            </div>
                     
                          <P class="right_sel">昵称不能超过15个字符或5个汉字</P>
                     <div class="right_page1">
                          <p class="right_sel right2">邮箱用来获取验证码，收不到邮件请到垃圾箱中寻找</p>
                          <p class="right_sel right3">点击将验证码发送到邮箱</p>
                          <p class="right_sel right3">此项为必填</p>
                          <p class="right_sel right4">此项为必填</p>
                     </div><!--right_page1-->
                     
      </div><!--end_main_container_left-->
    </div>

    </form>
     
  </div>  
  
   
   <div class="footer">
   </div> 

</div>
<?php
require_once("../repeat_code/footer.php");
?>
</body>
</html>



<script type="text/javascript">
$(document).ready(dosomething);
function dosomething()
{
//禁用按钮
$("#form_email_check").attr("disabled", true);
$("#form_nickname_check").attr("disabled", true);
$("#check_number").attr("disabled", true);
$("#sign_in_submit").attr("disabled", true);
	
}
</script>


