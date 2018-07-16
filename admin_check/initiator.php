<?php
require_once("../repeat_code/session_start.php");//包含会话开始文件
require_once("../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../repeat_code/manage_head.php");
$query0="SELECT * FROM user";
$result0=mysqli_query($dbc,$query0) or die('错误1');
$user_number=mysqli_num_rows($result0);
$query1="SELECT * FROM tutorial WHERE pass!=0";
$result1=mysqli_query($dbc,$query1) or die('错误2');
$pass_tutorial_number=mysqli_num_rows($result1);
$query2="SELECT * FROM tutorial WHERE youku_id!='0' AND pass=0";
$result2=mysqli_query($dbc,$query2) or die('错误3');
$query3="SELECT * FROM tutorial WHERE price!=0 AND pass=0";
$result3=mysqli_query($dbc,$query3) or die('错误4');
$no_pass_tutorial_number=mysqli_num_rows($result2)+mysqli_num_rows($result3);
$query4="SELECT * FROM tutorial WHERE youku_id='0' AND price=0";
$result4=mysqli_query($dbc,$query4) or die('错误5');
$no_send_youku=mysqli_num_rows($result4);
$t_zhuanti="SELECT * FROM tutorial WHERE category=0";
$t_zhuanti_result=mysqli_query($dbc,$t_zhuanti) or die('错误5');
$t_zhuanti_xinjian=mysqli_num_rows($t_zhuanti_result);
?>
<?php
$query5="SELECT * FROM examination WHERE pass!=0";
$result5=mysqli_query($dbc,$query5) or die('错误6');
$pass_examination_number=mysqli_num_rows($result5);
$query6="SELECT * FROM examination WHERE youku_id!='0' AND pass=0";
$result6=mysqli_query($dbc,$query6) or die('错误7');
$query7="SELECT * FROM examination WHERE price!=0 AND pass=0";
$result7=mysqli_query($dbc,$query7) or die('错误8');
$no_pass_examination_number=mysqli_num_rows($result6)+mysqli_num_rows($result7);
$query8="SELECT * FROM examination WHERE youku_id='0' AND price=0";
$result8=mysqli_query($dbc,$query8) or die('错误9');
$no_send_youku_examination=mysqli_num_rows($result8);
$e_zhuanti="SELECT * FROM examination WHERE category=0";
$e_zhuanti_result=mysqli_query($dbc,$e_zhuanti) or die('错误5');
$e_zhuanti_xinjian=mysqli_num_rows($e_zhuanti_result);
?>
<?php
$query9="SELECT * FROM solution WHERE pass!=0";
$result9=mysqli_query($dbc,$query9) or die('错误10');
$pass_solution_number=mysqli_num_rows($result9);
$query10="SELECT * FROM solution WHERE price!=0 AND pass=0";
$result10=mysqli_query($dbc,$query10) or die('错误12');
$no_pass_solution_number=mysqli_num_rows($result10);
$query11="SELECT * FROM tixian WHERE pass=0";
$result11=mysqli_query($dbc,$query11) or die('错误12');
$tixianrenshu=mysqli_num_rows($result11);
$s_zhuanti="SELECT * FROM solution WHERE category=0";
$s_zhuanti_result=mysqli_query($dbc,$s_zhuanti) or die('错误5');
$s_zhuanti_xinjian=mysqli_num_rows($s_zhuanti_result);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理界面</title>
<link href="initiator.css" rel="stylesheet" type="text/css" />
<link href="a.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="frame">
<div id="page">
<div class="_1">
<h1>用户信息</h1>
<p>注册用户：<?php echo $user_number?>人</p>
<a target="_blank" href="personal_index/tixian.php">提现请求：<?php echo $tixianrenshu?>个</a>
</div>
<div class="_1">
<h1>软件教程</h1>
<a target="_blank" href="/admin_check/tutorial/tutorial_topics.php"><p>现有教程：<?php echo $pass_tutorial_number?>个</p></a>
<a target="_blank" href="/admin_check/tutorial/video_topics.php"><p>未审核教程：<?php echo $no_pass_tutorial_number?>个</p></a>
<p>新建专题申请：<?php echo $t_zhuanti_xinjian?>个</p>
<p>未送往优酷：<?php echo $no_send_youku?>个</p>
</div>
<div class="_1">
<h1>大学课程</h1>
<a target="_blank" href="/admin_check/examination/examination_topics.php">
<p>现有课程：<?php echo $pass_examination_number?>个</p></a>
<a target="_blank" href="/admin_check/examination/video_topics.php">
<p>未审核课程：<?php echo $no_pass_examination_number?>个</p></a>
<p>新建专题申请：<?php echo $e_zhuanti_xinjian?>个</p>
<p>未送往优酷核：<?php echo $no_send_youku_examination?>个</p>
</div>
<div class="_1">
<h1>学习资料</h1>
<a target="_blank" href="/admin_check/key/key_topics.php">
<p>现有资料：<?php echo $pass_solution_number?>个</p></a>
<a target="_blank" href="/admin_check/key/key3.php">
<p>未审核资料：<?php echo $no_pass_solution_number?>个</p></a>
<p>新建专题申请：<?php echo $s_zhuanti_xinjian?>个</p>
</div>
</div>
</div>
</body>
</html>