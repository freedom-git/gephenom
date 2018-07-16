<?php
$targetFolder = '/key/keys/';
//video按钮
if($_FILES['video']['name']){
	$extension = substr(strrchr($_FILES['video']['name'],"."),1);
	$tempFile = $_FILES['video']['tmp_name'];
	$targetFile =$_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['video_random_name'].'.'.$extension;
	move_uploaded_file($tempFile,$targetFile);
}
?>