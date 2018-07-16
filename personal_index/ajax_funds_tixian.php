<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{
require_once("../repeat_code/session_start.php");//会话
require_once("../repeat_code/mysqli_connect.php");//数据库
//删除数据
if(!empty($_POST['cancel'])){
$query2="DELETE FROM tixian WHERE id='$_POST[cancel]' LIMIT 1";
$result2=mysqli_query($dbc,$query2)or die('查询出错');
	}
//支付宝提现
if($_POST['type']=='1'){
//标志变量
$mark=1;
if (preg_match('/^\d{11}$/',$_POST['zhanghao'])||(preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/',$_POST['zhanghao']))){$zhanghao = mysqli_real_escape_string($dbc,trim($_POST['zhanghao']));}else{$mark=0;echo '<script type="text/javascript">
alert("请输入正确的支付宝账户");
</script>';}
if(!empty($_POST['xingming1'])){$xingming1=mysqli_real_escape_string($dbc,trim($_POST['xingming1']));}else{$mark=0;echo '<script type="text/javascript">
alert("请输入账号绑定的姓名");
</script>';}
$money1=mysqli_real_escape_string($dbc,trim($_POST['money1']));
if($_POST['phone_number']!='手机号码'){$phone_number=mysqli_real_escape_string($dbc,trim($_POST['phone_number']));}
if(!empty($phone_number)&&!preg_match('/^\d{11}$/',$phone_number)){$mark=0;echo '<script type="text/javascript">
alert("请输入正确的手机号码");
</script>';}
if(!empty($_POST['yanzheng'])&&$_POST['yanzheng']==$_SESSION['check_number']){$yanzheng=mysqli_real_escape_string($dbc,trim($_POST['yanzheng']));}else{$mark=0;echo '<script type="text/javascript">
alert("验证码错误");
</script>';}
if($money1<50){$mark=0;echo '<script type="text/javascript">
alert("单笔提现金额需不小于50");
</script>';}
if($_SESSION['session_money']<$money1){$mark=0;echo '<script type="text/javascript">
alert("您的余额不足");
</script>';}
  if($mark==1){
  $query="INSERT INTO tixian (user_id,type,haoma,name,money,dianyin) VALUES ('$_SESSION[session_user_id]','1','$zhanghao','$xingming1','$money1','$phone_number')";
  $result=mysqli_query($dbc,$query)or die('查询出错');
  }
}

//银行提现
if($_POST['type']=='2'){
//标志变量
$mark=1;
if(!empty($_POST['yinghang'])){$yinghang=mysqli_real_escape_string($dbc,trim($_POST['yinghang']));}else{$mark=0;echo '<script type="text/javascript">
alert("请输入银行名称");
</script>';}
if(!empty($_POST['xingming2'])){$xingming2=mysqli_real_escape_string($dbc,trim($_POST['xingming2']));}else{$mark=0;echo '<script type="text/javascript">
alert("请输入开户姓名");
</script>';}
if(!empty($_POST['kahao'])){$kahao=mysqli_real_escape_string($dbc,trim($_POST['kahao']));}else{$mark=0;echo '<script type="text/javascript">
alert("请输入银行卡号");
</script>';}
if(!empty($_POST['yanzheng'])&&$_POST['yanzheng']==$_SESSION['check_number']){$yanzheng=mysqli_real_escape_string($dbc,trim($_POST['yanzheng']));}else{$mark=0;echo '<script type="text/javascript">
alert("验证码错误");
</script>';}
$money2=mysqli_real_escape_string($dbc,trim($_POST['money2']));
if($money2<50){$mark=0;echo '<script type="text/javascript">
alert("单笔提现金额需不小于50");
</script>';}
if($_SESSION['session_money']<$money2){$mark=0;echo '<script type="text/javascript">
alert("您的余额不足");
</script>';}
  if($mark==1){
  $query="INSERT INTO tixian (user_id,type,haoma,name,money,dianyin) VALUES ('$_SESSION[session_user_id]','2','$kahao','$xingming2','$money2','$yinghang')";
  $result=mysqli_query($dbc,$query)or die('查询出错');
  }
}
?>
<?php
//展现
$query1="SELECT * FROM tixian WHERE user_id='$_SESSION[session_user_id]' AND pass=0 LIMIT 1";
$result1=mysqli_query($dbc,$query1)or die('查询出错');
$i=mysqli_num_rows($result1);
$row=mysqli_fetch_array($result1);
if($i==0){
?>



<p class="buy_video_tittle">提现</p>

<div class="tixian_container">
<div class="ui-tab14">
        <ul class="ui-tab14-trigger fn-clear">
    	<li class="ui-tab14-trigger-item ui-tab14-trigger-item-current">
    		<span class="toAlipay-icon fn-left"><img src="../image/Unknown.png" /></span> 转账到支付宝
    	</li>
    	<li class="ui-tab14-trigger-item">
    		<span class="toBank-icon fn-left"><img src="../image/Unknown1.png" /></span> 转账到银行卡
    	</li>
    </ul>
    <!-- CMS:生活助手/转账到卡/转账到卡tab提示开始:personalprod/transfercore/tocarTabTip.vm --><!-- CMS:生活助手/转账到卡/转账到卡tab提示结束:personalprod/transfercore/tocarTabTip.vm -->    </div>
<h1 class="tittle_h1">学币兑人民币一比一提现,单笔提现的最低金额为50</h1>











<form>
<div class="zhifubao_container share_con">

<input type="hidden" value="1" id="type1" name="type1"/>
<div class="zhifubao_a share_input_con">
<p class="font_biaoxian">*您的支付宝账号：</p>
<input type="text" class="input_tixian_a input_tixian" value="<?php echo $zhanghao?>" name="zhanghao1" id="zhanghao"/>
</div><!--end_zhifubao_a-->
<div class="zhifubao_b share_input_con">
<p class="font_biaoxian">*账号绑定的姓名：</p>
<input type="text" class="input_tixian_a input_tixian" value="<?php echo $xingming1?>" name="xingming1" id="xingming1"/>
</div><!--end_zhifubao_b-->
<div class="zhifubao_c share_input_con">
<p class="font_biaoxian">*提现金额:</p>
<input type="number" class="input_tixian_b input_tixian" value="<?php echo $money1?>" name="money1" id="money1"/>
</div><!--end_zhifubao_c-->
<div class="zhifubao_d share_input_con">
<p class="font_biaoxian">*验证码：</p>
<input type="text" class="input_tixian_b input_tixian yanzheng" name="yanzheng1" id="yanzheng1"/>
<input type="button" class="submit_tixian get_yanzheng" value="获取验证码" id="get_yanzheng" />
</div><!--end_zhifubao_d-->
<div class="zhifubao_e share_input_con">
<p class="font_biaoxian">免费短信通知：</p>
<input type="text" class="input_tixian_a input_tixian" value="<?php echo $phone_number?>" name="phone_number" id="phone_number"/>
</div><!--end_zhifubao_e-->

<div class="zhifubao_f share_input_con">
<input value="确 定"  class="submit_tixian" type="button" id="tijiao1"/>
</div><!--end_zhifubao_f-->
</div><!--end_zhifubao_container-->
</form>













<form>

<div  class="yinhangka_container share_con">
<input type="hidden" value="2" id="type2" name="type2"/>
<div class="yinhangka_a share_input_con">
<p class="font_biaoxian">*银行：</p>
<input type="text" class="input_tixian_a input_tixian"  value="<?php echo $yinghang?>" name="yinghang" id="yinghang"/>
</div>
<div class="zhifubao_b share_input_con">
<p class="font_biaoxian">*银行卡卡号：</p>
<input type="text"  class="input_tixian_a input_tixian" value="<?php echo $kahao?>" name="kahao" id="kahao"/>
</div>
<div class="zhifubao_c share_input_con">
<p class="font_biaoxian">*开户人姓名：</p>
<input type="text"  class="input_tixian_a input_tixian" value="<?php echo $xingming2?>" name="xingming2" id="xingming2"/>
</div>
<div class="zhifubao_d share_input_con">
<p class="font_biaoxian">*提现金额:</p>
<input type="number"  class="input_tixian_b input_tixian" value="<?php echo $money2?>" name="money2" id="money2"/>
</div>
<div class="zhifubao_e share_input_con">
<p class="font_biaoxian">*验证码：</p>
<input type="text" class="input_tixian_b input_tixian yanzheng"  name="yanzheng2"  id="yanzheng2"/>
<input type="button" class="submit_tixian get_yanzheng" value="获取验证码" id="get_yanzheng" />
</div>
<div class="zhifubao_f share_input_con">
<input value="确 定" class="submit_tixian" type="button" id="tijiao2"/>
</div>
</div><!--end_yinhangka_container-->
</form>




</div><!--end_tixian_container-->


<?php }?>
<?php if($i==1){?>


<p class="buy_video_tittle">提现</p>
<div class="tixian_container">
<div class="ui-tab14">
   <ul class="ui-tab14-trigger fn-clear">
    	<li class="ui-tab14-trigger-item ui-tab14-trigger-item-current">
    		<span class="toAlipay-icon fn-left"><img src="../image/Unknown<?php if($_POST['type']=='2'){echo '1';}?>.png" /></span> 您的请求正在审核中
    	</li>
    	
    </ul>
<h1></h1>
</div>
<div class="shenhe">
<div class="shenhe_container shenhe_a">

<p class="font_biaoxian font_a">支付方式：</p>
<p class="font_b"><?php if($row['type']==1){echo '支付宝';}if($row['type']==2){echo '银行卡';}?></p>

</div>
<?php if($row['type']==2){echo '<div class="shenhe_container shenhe_g">
<p class="font_biaoxian font_a">银行：</p><p class="font_b">'.$row['dianyin'].'</p></div>';}?>

<div class="shenhe_container shenhe_b">
<p class="font_biaoxian font_a"><?php if($row['type']==1){echo '支付宝账号：</p><p class="font_b">'.$row['haoma'].'</p>';}if($row['type']==2){echo '银行卡号：</p><p class="font_b">'.$row['haoma'].'</p>';}?>
</div>


<div class="shenhe_container shenhe_c">
<p class="font_biaoxian font_a">姓名：</P><p class="font_b"><?php echo $row['name']?></p>
</div>

<div class="shenhe_container shenhe_d">
<p class="font_biaoxian font_a">金额：</p><p class="font_b"><?php echo $row['money']?></p>

</div>

<?php if($row['type']==1&&!empty($row['dianyin'])){echo '<div class="shenhe_container shenhe_e">
<p class="font_biaoxian font_a">短信通知手机号码:  </p><p class="font_b">'.$row['dianyin'].'</p></div>';}?>

<div class="shenhe_container shenhe_f">
<input  class="submit_tixian" type="button" value="取消" id="cancel"/>
</div>

</div>
</div>
<?php }?>
<script type="text/javascript">
//搜索按钮  post 地址
$('#tijiao1').bind
	('click',function()
	{	
	var zhanghao=$('#zhanghao').val();
	var xingming1=$('#xingming1').val();
	var money1=$('#money1').val();
	var phone_number=$('#phone_number').val();
	var type=$('#type1').val();
	var yanzheng=$('#yanzheng1').val();
	$.post('ajax_funds_tixian.php',{zhanghao:zhanghao,xingming1:xingming1,money1:money1,phone_number:phone_number,type:type,yanzheng:yanzheng},function(buy_video){
	$('.personal_right').empty();
	$('.personal_right').html(buy_video)
	},'html');
		});	 
			 
$('#tijiao2').bind
	('click',function()
	{	
	var yinghang=$('#yinghang').val();
	var kahao=$('#kahao').val();
	var xingming2=$('#xingming2').val();
	var money2=$('#money2').val();
	var type=$('#type2').val();
	var yanzheng=$('#yanzheng2').val();
	$.post('ajax_funds_tixian.php',{yinghang:yinghang,kahao:kahao,xingming2:xingming2,money2:money2,type:type,yanzheng:yanzheng},function(buy_video){
	$('.personal_right').empty();
	$('.personal_right').html(buy_video)
	},'html');
		});	 

<?php if(!empty($row['id'])){?>
$('#cancel').bind
	('click',function()
	{	
	var cancel=<?php echo $row['id']?>;
	$.post('ajax_funds_tixian.php',{cancel:cancel},function(buy_video){
	$('.personal_right').empty();
	$('.personal_right').html(buy_video)
	},'html');
		});	
<?php }?>
		
//提示文字
//account
$('#zhanghao').val('邮箱地址/手机号码');
$('#zhanghao').css("color","#CCC");
$('#zhanghao').focus(function(){
	$(this).val()=='邮箱地址/手机号码'? $(this).val(''): $(this);
	$('#zhanghao').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('邮箱地址/手机号码').css("color","#CCC"): $(this);
});

//phone_number
$('#phone_number').val('手机号码');
$('#phone_number').css("color","#CCC");
$('#phone_number').focus(function(){
	$(this).val()=='手机号码'? $(this).val(''): $(this);
	$('#phone_number').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('手机号码').css("color","#CCC"): $(this);
});

//yinghang
$('#yinghang').val('输入银行');
$('#yinghang').css("color","#CCC");
$('#yinghang').focus(function(){
	$(this).val()=='输入银行'? $(this).val(''): $(this);
	$('#yinghang').css("color","#000");

}).blur(function(){
   $(this).val()==''? $(this).val('输入银行').css("color","#CCC"): $(this);
});
//发送验证码
$('.get_yanzheng').bind
	('click',function()
	{
	var data1=0;
	$('.get_yanzheng').css("background-color","#8c8c8c");
	$(".get_yanzheng").attr("disabled", true);
	$.post('ajax_funds_tixian_youjian.php',data1,function(data1){
		alert(data1);
		},'html');	
	}
	);
	
	
	
	//选择支付宝或银行卡
	$('.share_con:gt(0)').hide();
				$('.ui-tab14-trigger > li:eq(0)').addClass('active');
				$('.ui-tab14-trigger > li').click(showHideTabs);
				$('#addTab').click(addTab);				

				function showHideTabs()
				{
					var allLi = $('.ui-tab14-trigger > li').removeClass('active');
					$(this).addClass('active');
					var index = allLi.index(this);
					$('.share_con:visible').hide();
					$('.share_con:eq('+index+')').show();
				}
	
	
	
</script>
<?php

	}
else{echo '该页面不允许直接浏览';}
?>