<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
$query_user_information="SELECT * FROM user WHERE id=$_SESSION[session_user_id]";
$result_user_information=mysqli_query($dbc,$query_user_information) or die('出错');
$row_user_information=mysqli_fetch_array($result_user_information)
?>
<div class="personal_left">
   <div class="left_welcome">
               <div class="welcome_top"> 
               <p class="nam"><?php if(isset($_GET['nickname'])){echo $_GET['nickname'];}else{echo $_SESSION['session_nickname'];}?></p>

        </div>
        <div class="welcome_middle"><img src="/image/logo.png" width="60px" height="60px" />
        </div>
        <div class="welcome_bottom">
        <a id="account" href="#"><p class="mor">返回</p></a>
        </div>
   </div>  <!--end_left_welcome-->
   <div class="left_select">
       
       <!-- <div>
            <h1>个人资料</h1>
            <div class="tow">
            <p id="acount_2" class="tow_p">基本信息</p>
                <p id="acount_3" class="tow_p">设置头像</p>
                <p id="acount_6" class="tow_p">个人经历</p>
            </div>
        </div>-->
  <!--      <div>
            <h1>账号绑定</h1>
            <div class="tow">
                <p id="acount_7" class="tow_p">手机绑定</p>
                <p id="acount_8" class="tow_p">邮箱绑定</p>
            </div>
        </div> -->
        <div>
            <a href="/login/forgot_password.php"><h1 class="forget">修改登录密码</h1></a>
          <!--  <div class="tow">
                <p id="acount_10" class="tow_p">修改登录密码</p>
            </div>-->
        </div>
 
        
        
   </div>  <!--end_left_select-->
</div>  <!--end_personal_left-->
<div class="load">
</div>
	<div class="personal_right">
		<div class="right_count">
			<div class="my_account">
				<p class="account_tittle">基本信息</p>
				<ul>
				  <li><p class="account_infor">您&nbsp;的&nbsp;昵&nbsp;称:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['session_nickname'];?></p></li>
                  <li><p class="account_infor">登&nbsp;录&nbsp;邮&nbsp;箱:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_user_information['email'];?></p></li>
           <!--       <li><p class="account_infor">手&nbsp;机&nbsp;号&nbsp;码:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_user_information['phone_number'];?></p></li>
              <li><p class="account_infor">Q&nbsp;&nbsp;Q&nbsp;&nbsp;号&nbsp;码:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_user_information['qq'];?></p></li> -->
                    
                </ul>
        	</div>
     <!--       <div class="my_account">
            	<p class="account_tittle">安全信息</p>
                <ul>
                	<li><p class="account_infor">手&nbsp;机&nbsp;绑&nbsp;定:&nbsp;&nbsp;&nbsp;&nbsp;<?php if(empty($row_user_information['phone_number'])){echo '未绑定&nbsp;&nbsp;&nbsp;&nbsp;<a title="修改" href="">绑定手机</a></p></li>';}else{echo '已绑定&nbsp;&nbsp;&nbsp;&nbsp;<a title="修改" href="">修改号码</a></p></li>';}?>
                    <li><p class="account_infor">邮&nbsp;箱&nbsp;绑&nbsp;定:&nbsp;&nbsp;&nbsp;&nbsp;<?php if(empty($row_user_information['email'])){echo '未绑定&nbsp;&nbsp;&nbsp;&nbsp;<a title="修改" href="">绑定邮箱</a></p></li>';}else{echo '已绑定&nbsp;&nbsp;&nbsp;&nbsp;<a title="修改" href="">修改号码</a></p></li>';}?>
                </ul>
            </div> -->
            <div class="my_account">
            	<p class="account_tittle">资金信息</p>
                <div class="my_account3_div"><p class="account_infor">可&nbsp;用&nbsp;余&nbsp;额：&nbsp;&nbsp;&nbsp;&nbsp;<span class="my_account3_span"><?php echo $_SESSION['session_money'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;学币&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
            </div>
		</div>  <!--end_right_count-->
    </div>  <!--end_personal_right-->
<script type="text/javascript">
			$(document).ready(function ()
			{
				$('.tow').hide();
				
				$('h1').click(function()
				{
					var h1 = $(this);
					h1.next('div').slideToggle('fast');
				});
				
						 //实现焦点
	 
$(function(){
    $('.tow > p').click(function(){ 
	   $('.tow > p').removeClass("tow_p_focus");
	   $(this).addClass("tow_p_focus");
		 }); 	 
	 });	
			});
			
			
			
	//我的账号
		$(function(){
	$('#acount_1').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_1.php');
	}); 	 
	});
	//基本信息
	$(function(){
	$('#acount_2').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_2.php');
	}); 	 
	});
	//设置头像
	$(function(){
	$('#acount_3').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_3.php');
	}); 	 
	});
	//个人经历
	$(function(){
	$('#acount_6').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_4.php');
	}); 	 
	});
	//手机绑定
	$(function(){
	$('#acount_7').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_5.php');
	}); 	 
	});
	//邮箱绑定
	$(function(){
	$('#acount_8').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_6.php');
	}); 	 
	});
	//修改密码
	$(function(){
	$('#acount_10').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_7.php');
	}); 	 
	});
	//我的账户信息
	$(function(){
	$('#acount_11').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_8.php');
	}); 	 
	});
	//我的支出
	$(function(){
	$('#acount_12').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_9.php');
	}); 	 
	});
	//我做的任务
	$(function(){
	$('#acount_13').click(function(){ 
	$('.personal_right').empty();
	$('.personal_right').load('ajax_account_10.php');
	}); 	 
	});
			
	
			
			
			
$(function(){
    $('#account').click(function(){ 
	$('.container').empty();
	$('.container').load('ajax_acount.php');
		 });
	 });			
			
			
</script>