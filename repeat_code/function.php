<?php
require_once("mysqli_connect.php");//包含数据库连接文
?>
<?php
//检查上传文件类型
function typecheck($upload_file_name,$pass_type){ 
$kzm = substr(strrchr($upload_file_name,"."),1); 
$is_pass = in_array(strtolower($kzm),$pass_type); 
if($is_pass){ 
return true; 
}else{ 
return false; 
} 
}
?>
<?php
//价格
function check_price($str){
	$a="/^\d+(\.\d{1,2})?$/";
	if(preg_match($a,$str)){
		return true;}
		else{
			return false;}
}
?>
<?php
//检查输入字符数
function strlen_utf8($str) {  
$i = 0;
$count = 0;  
$len = strlen ($str);  
while ($i < $len) {  
$chr = ord ($str[$i]);  
$count++;  
$i++;  
if($i >= $len) break;  
if($chr & 0x80) {  
$chr <<= 1;  
while ($chr & 0x80) {  
$i++;  
$chr <<= 1;  
}
}
}
return $count;  
}
?>
<?php
//验证账号是否存在,默认已经包含数据库启动文件
function check_account($account){	
	require("mysqli_connect.php");
	global $way;
	if (preg_match('/^\d{11}$/',$account)){$way = 'phone_number';}
	if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/',$account)){/*$domain=preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/','',$email);	if(checkdnsrr($domain)){*/$way='email';/*}*/
	}
	if(!($way=='phone_number')&&!($way=='email')){$way='nickname';}
	$query="SELECT * FROM user WHERE $way='$account'";
	$result=mysqli_query($dbc,$query) or die ('查询数据库出错');
	if(!$row=mysqli_fetch_array($result)){echo '×';}else{echo '√';}
	}
?>
<?php
//guid随机数
function guid(){
if (function_exists('com_create_guid')){
return com_create_guid();
}else{
mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
$charid = strtoupper(md5(uniqid(rand(), true)));
$hyphen = chr(45);// "-"
$uuid = chr(123)// "{"
.substr($charid, 0, 8).$hyphen
.substr($charid, 8, 4).$hyphen
.substr($charid,12, 4).$hyphen
.substr($charid,16, 4).$hyphen
.substr($charid,20,12)
.chr(125);// "}"
return $uuid;
}
}
?>
<?php
//处理搜索的字符串
/*
$c=被搜索的信息
$a="video_heading"  搜索的字段
$b="OR"或"AND"
$e=WHERE/AND/OR
*/
function deal($c,$a,$b,$e){
$where_list=array();
$final_search_words=array();
$clean_search=str_replace('，',' ',$c);
$clean_search=str_replace(',',' ',$clean_search);
$search_words = explode(' ',$clean_search);
if (count($search_words)>0){
	foreach($search_words as $word){
		if(!empty($word)){
			$final_search_words[]=$word;
			}
		}
	}
if(count($final_search_words)>0){
	foreach($final_search_words as $word){$where_list[]="$a LIKE '%$word%'";}}
$where_clause=implode(" $b ",$where_list);
if(!empty($where_clause)){
	$search_query.=" $e $where_clause";
	}
	return $search_query;
}
?>
<?php
//已知最后日期  计算于现在相差天数
function day($date){
	list($y,$m,$d)=explode('-',$date);
	$day=ceil((mktime(0,0,0,$m,$d,$y)-time())/3600/24);
	return $day;
	}
?>
<?php
function get_password($length)
{
    $str = substr(md5(time()), 0, $length);
    return $str;
}
?>
<?php
function cut($str_cut,$length)
{
    if (strlen($str_cut) > $length)
    {
        for($i=0; $i < $length; $i++)
        if (ord($str_cut[$i]) > 128)    $i++;
        $str_cut = substr($str_cut,0,$i);
    }
    return $str_cut;
}
?>