<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
//删除文件
	$targetFolder = '/examination/examinations/';
	if(isset($_POST['what'])){
		unlink($_SERVER['DOCUMENT_ROOT'].$targetFolder.$_POST['what']);
	}
}else{
	echo '该页面不允许直接浏览';
	}
?>