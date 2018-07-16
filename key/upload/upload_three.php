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
if(!isset($_SESSION['k_mark'])){
$upload_mark=0;
$error='';
//视频验证
$video=mysqli_real_escape_string($dbc,trim($_POST['video2']));
if(empty($video)){$upload_mark=1;$error='视频上传失败<br />';}
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

$price=mysqli_real_escape_string($dbc,trim($_POST['price']));

	if(check_price($price)){//格式符合
		if($price<1||$price>100){$upload_mark=1;$error=$error.'价格必须大于1小于20';}}
	if(!check_price($price)){//格式不符
		$upload_mark=1;$error=$error.'价格应为二位小数<br />';}


//学校验证
$school=mysqli_real_escape_string($dbc,trim($_POST['school']));
if(strlen_utf8($school)<1||strlen_utf8($school)>30){$upload_mark=1;$error=$error.'学校名称长度应该大于1小于30<br />';}
//专业验证
$subject=mysqli_real_escape_string($dbc,trim($_POST['subject']));
if(strlen_utf8($subject)<1||strlen_utf8($subject)>30){$upload_mark=1;$error=$error.'专业名称长度应该大于1小于30<br />';}
//教材信息验证
$is_id=mysqli_real_escape_string($dbc,trim($_POST['is_id']));
if($is_id==0){//没有选择图片时
	$text_name=mysqli_real_escape_string($dbc,trim($_POST['text_name']));
	$text_author=mysqli_real_escape_string($dbc,trim($_POST['text_author']));
	if(strlen_utf8($text_name)<1||strlen_utf8($text_name)>30){$upload_mark=1;$error=$error.'教材名称长度应该大于1小于30<br />';}
	if(strlen_utf8($text_author)<1||strlen_utf8($text_author)>30){$upload_mark=1;$error=$error.'作者姓名长度应该大于1小于30<br />';}
}
//简介验证
$summary=mysqli_real_escape_string($dbc,trim($_POST['summary']));
if(strlen_utf8($summary)>500){$upload_mark=1;$error=$error.'视频介绍应该小于500<br />';}
if($is_new==1){//新建专题时
	$summary='*'.$cat1.'*'.$cat2.'*'.$summary;
}
if($is_id==0){//没有选择图片时
	$summary='*'.$text_name.'*'.$text_author.'*'.$summary;
}
//封面图片验证
$title_picture=mysqli_real_escape_string($dbc,trim($_POST['title_picture']));
//用户id
$user_id=$_SESSION['session_user_id'];
//插入数据
if($upload_mark==0){
	$query="INSERT INTO solution (category,price,heading,video,summary,title_picture,user_id,school,subject) values('$category','$price','$heading','$video','$summary','$title_picture','$user_id','$school','$subject')";
	mysqli_query($dbc,$query) or die(数据库出现错误);
	$_SESSION['k_mark']=1;
	?>
	<div id="frame">
	<div id="page">
    	<div class="tell">
        	<p class="tell1">资料上传成功</p>
            <p class="tell1">您的资料将在三个工作日内审核完毕</p>
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