<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 
$code=$_GET['code'];
echo 'code='.$code;
?>


<form action="https://openapi.youku.com/v2/oauth2/token" method="post"> 
<input value="7689d06ecd625c63" type="text" id="client_id" name="client_id" />
<input type="text" value="01cdc56891be27aa1a2616dbabd2f933" id="client_secret" name="client_secret" />
<input type="text" value="authorization_code" id="grant_type" name="grant_type" />
<input type="text" value="<?php echo $code;?>" id="code" name="code" />
<input type="text" value="http://www.gephenom.com/tools/youku.php" id="redirect_uri" name="redirect_uri" />             

                   
<input id="sign_in_submit" name="sign_in_submit" type="submit" value="同意条款并提交" />

</form>

</body>
</html>
