<?php
require_once("../../repeat_code/session_start.php");
require_once("../../repeat_code/head.php");
require_once("../../repeat_code/member.php");
?>
<!--<meta http-equiv="refresh" content="5; url=/index.php" />-->
<title>上传视频教程</title>
<link type="text/css" rel="stylesheet" href="upload_three.css"/>
</head>
<?php
require_once("../../repeat_code/nav.php");
?>
<body>
<?php
require_once("../../repeat_code/function.php");
if(!isset($_SESSION['t_mark'])){
$upload_mark=0;
$error='';
//视频验证
$video=mysqli_real_escape_string($dbc,trim($_POST['video2']));
if(empty($video)){$upload_mark=1;$error='视频上传失败<br />';}
//专辑验证
$series_id=mysqli_real_escape_string($dbc,trim($_POST['series']));
//专题验证
$is_new=mysqli_real_escape_string($dbc,trim($_POST['is_new']));
if($is_new==1){//新建专题时
	$category=0;
	$cat1=mysqli_real_escape_string($dbc,trim($_POST['cat1']));
	$cat2=mysqli_real_escape_string($dbc,trim($_POST['cat2']));
	if(strlen_utf8($cat1)<1||strlen_utf8($cat1)>30){$upload_mark=1;$error=$error.'专题大类长度小于30<br />';}
	if(strlen_utf8($cat2)<1||strlen_utf8($cat2)>30){$upload_mark=1;$error=$error.'专题小类长度小于30<br />';}
}
if($is_new==2){//非新建专题时
	$category=mysqli_real_escape_string($dbc,trim($_POST['category']));
	if(empty($category)){$upload_mark=1;$error=$error.'专题不能为空<br />';}
}
if(!($is_new==2||$is_new==1)){$upload_mark=1;$error=$error.'专题信息出错<br />';}
//标题验证
$heading=mysqli_real_escape_string($dbc,trim($_POST['heading']));
if(strlen_utf8($heading)<1||strlen_utf8($heading)>50){$upload_mark=1;$error=$error.'标题长度应该大于1小于50<br />';}
//价格验证
$is_free=mysqli_real_escape_string($dbc,trim($_POST['is_free']));
$price=mysqli_real_escape_string($dbc,trim($_POST['price']));
if($is_free==1){//免费时
$price=0;
	if($price!=0){$upload_mark=1;$error=$error.'免费视频价格必须为0<br />';}
}
if($is_free==2){//免费时
	if(check_price($price)){//格式符合
		if($price<1||$price>100){$upload_mark=1;$error=$error.'付费视频价格必须大于1小于100';}}
	if(!check_price($price)){//格式不符
		$upload_mark=1;$error=$error.'价格应为二位小数<br />';}
}
//简介验证
$summary=mysqli_real_escape_string($dbc,trim($_POST['summary']));
if(strlen_utf8($summary)>500){$upload_mark=1;$error=$error.'视频介绍应该小于500<br />';}
if($is_new==1){//新建专题时
	$summary='*'.$cat1.'*'.$cat2.$summary;
}
//封面截图验证
$title_picture=mysqli_real_escape_string($dbc,trim($_POST['title_picture2']));
if(empty($title_picture)){$upload_mark=1;$error='封面图片上传失败<br />';}
//截图验证
$upload_picture=mysqli_real_escape_string($dbc,trim($_POST['upload_picture2']));
$a=array();
$b=array();
$a=explode('*',$upload_picture);
foreach($a as $value){
	if($value!=''){
		$b[]=$value;
	}
}
$up_pic1=$b[0];
$up_pic2=$b[1];
$up_pic3=$b[2];
$up_pic4=$b[3];
$up_pic5=$b[4];
//附件验证
$attachment=mysqli_real_escape_string($dbc,trim($_POST['attachment2']));
//用户id
$user_id=$_SESSION['session_user_id'];
//插入数据
if($upload_mark==0){
	$query="INSERT INTO tutorial (category,heading,video,summary,upload_picture1,upload_picture2,upload_picture3,upload_picture4,upload_picture5,attachment,price,title_picture,user_id,series_id) values('$category','$heading','$video','$summary','$up_pic1','$up_pic2','$up_pic3','$up_pic4','$up_pic5','$attachment','$price','$title_picture','$user_id','$series_id')";
	$_SESSION['t_mark']=1;
	mysqli_query($dbc,$query) or die(数据库出现错误);

	?>
	<div id="frame">
	<div id="page">
    	<div class="tell">
        	<p class="tell1">教程上传成功</p>
            <p class="tell1">您的教程将在三个工作日内审核完毕</p>
            <br /><br />
            <a class="tell2" href="upload.php">继续上传</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="tell2" href="/index.php">返回首页</a>
    	</div>
	</div>
</div>
<?php	
	
}else{
?>
<div id="frame">
	<div id="page">
    	<div class="tell">
        	<p class="tell1">教程上传失败</p>
            <br /><br />
			<p class="tell2"><?php echo $error;?></p>
            <a class="tell2" href="upload.php">继续上传</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="tell2" href="/index.php">返回首页</a>
    	</div>
	</div>
</div>
<?php
}
}
?>


</body>
</html>