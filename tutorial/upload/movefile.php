<?php
//上传插件处理程序
$targetFolder = '/tutorial/tutorials/';
//专辑图片
if($_FILES['series_picture']['name']){
	$extension = substr(strrchr($_FILES['series_picture']['name'],"."),1);
	$tempFile = $_FILES['series_picture']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['series_picture_random_name'].'.'.$extension;
	move_uploaded_file($tempFile,$targetFile);
}
//video按钮
if($_FILES['video']['name']){
	$extension = substr(strrchr($_FILES['video']['name'],"."),1);
	$tempFile = $_FILES['video']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['video_random_name'].'.'.$extension;
	move_uploaded_file($tempFile,$targetFile);
}
//封面截图上传
if($_FILES['title_picture']['name']){
	$extension = substr(strrchr($_FILES['title_picture']['name'],"."),1);
	$tempFile = $_FILES['title_picture']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['title_picture_random_name'].'.'.$extension;
	move_uploaded_file($tempFile,$targetFile);
}
//截图商场
if($_FILES['upload_picture']['name']){
	$extension = substr(strrchr($_FILES['upload_picture']['name'],"."),1);
	$tempFile = $_FILES['upload_picture']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['upload_picture_random_name'].$_POST['up_pic_order'].'.'.$extension;
	move_uploaded_file($tempFile,$targetFile);
}
//attachment按钮
if($_FILES['attachment']['name']){
	$extension = substr(strrchr($_FILES['attachment']['name'],"."),1);
	$tempFile =$_FILES['attachment']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['attachment_random_name'].'.'.$extension;
	move_uploaded_file($tempFile,$targetFile);
}

?>