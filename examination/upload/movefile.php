<?php
//上传插件处理程序
$targetFolder = '/examination/examinations/';
//video按钮
if($_FILES['video']['name']){
	$extension = substr(strrchr($_FILES['video']['name'],"."),1);
	$tempFile = $_FILES['video']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['video_random_name'].'.'.$extension;
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