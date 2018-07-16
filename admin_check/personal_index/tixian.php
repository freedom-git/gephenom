<?php
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../repeat_code/manage_head.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现</title>
</head>
<?php
$query="SELECT t.*,u.nickname,u.money AS yue ".
"FROM tixian AS t ".
"INNER JOIN user AS u ON (t.user_id=u.id) ".
"WHERE pass=0";
$result=mysqli_query($dbc,$query) or die('错误1');
$tixianrenshu=mysqli_num_rows($result);
?>
<body>
<?php
while($row=mysqli_fetch_array($result)){
	?>
	<h1><?php echo $row['nickname']?>的提现请求，他当前的余额为<?php echo $row['yue']?>，申请时间：<?php echo $row['time']?></h1>
<p>支付方式：<?php if($row['type']==1){echo '支付宝';}if($row['type']==2){echo '银行卡';}?></p>
<?php if($row['type']==2){echo '<p>银行:'.$row['dianyin'].'</p>';}?>
<p><?php if($row['type']==1){echo '支付宝账号：'.$row['haoma'];}if($row['type']==2){echo '银行卡号：'.$row['haoma'];}?></p>
<P>姓名：<?php echo $row['name']?></P>
<p>金额：<?php echo $row['money']?></p>
<?php if($row['type']==1&&!empty($row['dianyin'])){echo '<p>短信通知手机号码:'.$row['dianyin'].'</p>';}?>
<?php
$query1="SELECT * FROM trade WHERE user_id='$row[user_id]' AND (type=4 OR type=6 OR type=8)";
$result1=mysqli_query($dbc,$query1) or die('错误2');
$_i1=0;
while($row1=mysqli_fetch_array($result1)){$_i1+=$row1['how_much'];}
$query2="SELECT * FROM trade WHERE user_id='$row[user_id]' AND (type=3 OR type=5 OR type=7)";
$result2=mysqli_query($dbc,$query2) or die('错误3');
$_i2=0;
while($row2=mysqli_fetch_array($result2)){$_i2+=$row2['how_much'];}
$query3="SELECT * FROM trade WHERE type=1 AND user_id='$row[user_id]'";
$result3=mysqli_query($dbc,$query3) or die('错误4');
$_i3=0;
while($row3=mysqli_fetch_array($result3)){$_i3+=$row3['how_much'];}
$query4="SELECT * FROM trade WHERE type=2 AND user_id='$row[user_id]'";
$result4=mysqli_query($dbc,$query4) or die('错误5');
$_i4=0;
while($row4=mysqli_fetch_array($result4)){$_i4+=$row4['how_much'];}
?><br />
总支出：<?php echo $_i2;?>-总收入：<?php echo $_i1;?>=<?php echo $_i2-$_i1;?><br />
总充值：<?php echo $_i3;?>-总提现：<?php echo $_i4;?>=<?php echo $_i3-$_i4;?><br />
<?php if(($_i1-$_i2)==($_i3-$_i4)){echo '收支平衡';}else{echo '收支不平衡 有问题！';}?>
<a target="_blank" href="personal_index.php?id=<?php echo $row['user_id'];?>">查看明细</a>
<?php if($row['yue']>=$row['money']){?>
<form target="_blank" method="post" action="tixian_youjian.php">
<input type="hidden" name="id" value="<?php echo $row['id']?>"/>
<input type="submit" value="通过" name="tongguo"/>
</form>
<?php }?>
<form target="_blank" method="post" action="tixian_youjian.php">
拒绝原因：
<textarea name="yuanyin"></textarea>
<input type="hidden" name="id" value="<?php echo $row['id']?>"/>
<input type="submit" value="拒绝" name="jujue"/>
</form>
<?php }?>
</body>
</html>
