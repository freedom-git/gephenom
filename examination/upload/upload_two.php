<?php
require_once("../../repeat_code/session_start.php");
require_once("../../repeat_code/head.php");
require_once("../../repeat_code/function.php");
unset($_SESSION['e_mark']);
$video_random_name=guid().date('Y-m-d-H-i-s',time());//视频随机名字
$attachment_random_name=guid().date('Y-m-d-H-i-s',time());//附件随机名字
?>
<title>上传视频教程</title>
<link type="text/css" rel="stylesheet" href="upload_two.css"/>
<link href="/uploadify/uploadify2.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var video_i=1;//视频上传数量限制
	var attachment_i=1;//附件上传数量限制
	var mark1;//视频控制变量
	var mark3;//标题
	var mark4;//价格
	var mark6=1;//新建专辑
	var mark5;//专题
	var cat_mark1=0;//专题类别1
	var cat_mark2=0;//专题类别2
	var mark7;//学校
	var mark8;//专业
	var mark9;//书名
	var mark10;//作者
	var mark11;//书
//初始设置
	$('#to_upload').click(function(){$('#upload_video').submit();});
	$('.upload_input5').hide();
	$('.series_new_can_a').hide();
	$('.series_new_sub').hide();
//已选择图片
<?php
if($_GET['id']!=11){
?>
	mark11=1;
<?php
}
//免费时
if($_GET['free']==1){
?>
	mark4=1;
	$('#price').val(0);
	$('#price').attr('disabled','disabled');
<?php
}
?>
//专题验证
<?php
if($_GET['new']==2){
?>
	mark5=1;
	$('.r_category').css("color","#22cacc");
<?php
}
?>
	$('#cat1').bind('blur keyup focus',cat1_check);
	function cat1_check(){
		mark5=0;cat_mark1=0;
		var cur=$(this);
		var cat1_length=cur.val().length;
		$('.r_category').css("color","#9a9a9a");
		if(cat1_length<1||cat1_length>30)//无论汉子还是字母都站1字符
		{
			$('#to_upload').attr('disabled',true);
			$('.r_category').css("color","#F00");
			cat_mark1=0;
		}
		else
		{
			cat_mark1=1;
			if(cat_mark1==0||cat_mark2==0){
				$('.r_category').css("color","#F00");
			}
			
		}
		if(cat_mark1==1&&cat_mark2==1)
			{mark5=1;$('.r_category').css("color","#22cacc");
			}
			
			if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		
	}
	
	$('#cat2').bind('blur keyup focus',cat2_check);
	function cat2_check(){
		mark5=0;cat_mark2=0;
		var cur=$(this);
		var cat2_length=cur.val().length;
		$('.r_category').css("color","#9a9a9a");
		if(cat2_length<1||cat2_length>30)//无论汉子还是字母都站1字符
		{
			$('#to_upload').attr('disabled',true);
			$('.r_category').css("color","#F00");
			cat_mark2=0;
		}
		else
		{
			cat_mark2=1;
			if(cat_mark1==0||cat_mark2==0){
				$('.r_category').css("color","#F00");
			}
		}
		if(cat_mark1==1&&cat_mark2==1)
			{mark5=1;$('.r_category').css("color","#22cacc");
			}
			
			if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
//专题验证结束
//专辑取消按钮
	$('.series_new_can_a').click(function(){
		mark6=1;
		$('.r_series').html('请选择是否将该教程纳入专辑');
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
		$('#to_upload').removeAttr('disabled');}
		$('.series_new_a').show();
		$('.upload_select').show();
		$('.upload_input5').hide();
		$('.series_new_can_a').hide();
		$('#series_check').hide();
		$('.series_new_sub').hide();
		$('.r_series').css("color","#9a9a9a");
	});
//新建专辑按钮
	$('.series_new_a').click(function(){
		mark6=0;
		$('.r_series').html('请输入1至30个汉字或字符');
		$('.r_series').css("color","#F00");
		$('#to_upload').attr('disabled',true);
		$('.series_new_can_a').show();
		$('.series_new_a').hide();
		$('.upload_select').hide();
		$('.upload_input5').show();
		$('#series_check').show();
		$('.series_new_sub').show();
		$('#series_check').empty();
		$('.series_new_sub').attr('disabled','disabled');
	});
//专辑提交按钮
	$('.series_new_sub').click(function(){
		$('.r_series').css("color","#22cacc");
		mark6=1;
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
		$('#to_upload').removeAttr('disabled');}
		$('.r_series').html('请选择是否将该教程纳入专辑');
		$('.r_series').css("color","#9a9a9a");
		$('#series_check').hide();
		$('.upload_input5').hide();
		$('.series_new_sub').hide();
		$('.series_new_can_a').hide();
		$('.series_new_a').hide();
		var data2=$('#upload_video').serialize();
		$.post('series_sunmit.php',data2,function(series_name){
		$('.series_left').html(series_name)
		},'html');
	});
//专辑输入
	$('.upload_input5').bind('blur keyup focus',series_new);
	function series_new(){
		var data=$('.upload_input5').serialize();
		$.post('series_new.php',data,function(series_name){
		$('#series_check').html(series_name);
		if(series_name!='可用'){
			$('.series_new_sub').attr('disabled','disabled');
		}
		else{
			$('.series_new_sub').removeAttr('disabled');
		}
		
		},'html');		
	}
	
//视频upload
	$('#video').uploadify({
		'fileObjName'	  :'video',
		'swf'  	          :'/uploadify/uploadify.swf',
		'uploader'    	  :'movefile.php',
		'fileTypeDesc'    :'可选的文件类型',
		<?php
		if($_GET['free']==1){
			?>
		'fileTypeExts'    :'*.mp4;',
		'fileSizeLimit'	  :'1000MB',

			<?php
		}
		?>
		
		<?php
		if($_GET['free']==2){
			?>
		'fileTypeExts'    :'*.swf;',
		'fileSizeLimit'	  :'150MB',

			<?php
		}
		?>
		'multi'			  :false,//同时间允许选取多个文件
		'uploadLimit'  : video_i,//允许上传的总数
		'removeCompleted'  :false,//上传完成后进度条是否消失
		'progressData'	  :'speed',
		'auto'			  :true,
		'formData'        :{'video_random_name':'<?php echo $video_random_name;?>'},
		//'buttonClass':'video_but_cla',//button的class
		'buttonText':'选择文件',
		//'checkExisting':'',//检查存在的后台路径
		//'height':'',
		//'width':'',
		//'itemTemplate' : '',
		//'overrideEvents':'',//不懂
		'queueID':'video_queue',//不懂
		'queueSizeLimit':1,//同时允许的最大上传数量 
		//'requeueErrors':'',//重复上传，出错时

/*	
	'onUploadStart': function(file) {$("#file_upload").uploadify("settings", "someOtherKey", 2);},
		'onQueueComplete':function(queueData){},
		'onCancel':function(file){},
'onUploadComplete':function(file,data,response){},
	*/
		'onSelect':function(file){
			var video_name='<?php echo $video_random_name;?>'+file.type;
			$('.r_video').css("color","#F00");
			$('#to_upload').attr('disabled',true);
			$('#video').uploadify('disable',true);
	var cancel=$("#"+file.id + " .cancel a");  
    if (cancel) {  
		cancel.on('click',function () {  
			$('.r_video').css("color","#F00");
			$('#to_upload').attr('disabled',true);mark1=0;
			video_i++;
			$('#video').uploadify('disable',false);
			$('#video').uploadify('settings','uploadLimit',video_i);
			$.post('delete.php',{what:video_name});
		});  
   }
			},//onselect结束
	
		'onUploadSuccess' : function(file, data, response) {
			var video_name='<?php echo $video_random_name;?>'+file.type;
			$('#video2').val(video_name);
			$('.r_video').css("color","#22cacc");
			mark1=1;
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	var cancel=$("#"+file.id + " .cancel a");  
    if (cancel) {  
		cancel.on('click',function () {  
			$('.r_video').css("color","#F00");
			$('#to_upload').attr('disabled',true);mark1=0;
			video_i++;
			$('#video').uploadify('disable',false);
			$('#video').uploadify('settings','uploadLimit',video_i);
			$.post('delete.php',{what:video_name});
		});  
   }   
   },//onsuccess结束	
	});
	
//attachment upload
	$('#attachment').uploadify({
		'fileObjName'	  :'attachment',
		'swf'  	          :'/uploadify/uploadify.swf',
		                                              'uploader'    	  :'movefile.php',		'fileTypeDesc'    :'可选的文件类型',
		'fileTypeExts'    :'*.rar;*.zip;',
		'fileSizeLimit'	  :'50MB',
		'multi'			  :false,//同时间允许选取多个文件
		'uploadLimit'     :attachment_i,//允许上传的总数
		'removeCompleted'  :false,//上传完成后进度条是否消失
		'progressData'	  :'speed',
		'auto'			  :true,
		'formData'		  :{'attachment_random_name':'<?php echo $attachment_random_name;?>'},
		//'buttonClass':'',//button的class
		'buttonText':'选择文件',
		//'checkExisting':'',//检查存在的后台路径
		//'height':'',
		//'width':'',
		//'itemTemplate' : '',
		//'overrideEvents':'',//不懂
		'queueID':'att_queue',//att行列
		'queueSizeLimit':1,//同时允许的最大上传数量 
		//'requeueErrors':'',//重复上传，出错时
		'onSelect':function(file){
			var attachment_name='<?php echo $attachment_random_name;?>'+file.type;
			$('#to_upload').attr('disabled',true);
			$('.r_attachment').css("color","#F00");
			$('#attachment').uploadify('disable',true);
			var cancel=$("#"+file.id + " .cancel a");  
    		if (cancel) {  
				cancel.on('click',function(){  
				attachment_i++;
				$('#attachment').uploadify('disable',false);
				$('#attachment').uploadify('settings','uploadLimit',attachment_i);
				$.post('delete.php',{what:attachment_name});
				$('.r_attachment').css("color","#9a9a9a");
				});
//正在上传时验证
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
			}//点差按钮结束
		},//select结束
		'onUploadSuccess' : function(file, data, response) {
			var attachment_name='<?php echo $attachment_random_name;?>'+file.type;
			$('#attachment2').val(attachment_name);
			$('.r_attachment').css("color","#22cacc");
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	var cancel=$("#"+file.id + " .cancel a");  
    if (cancel) {  
		cancel.on('click',function(){ 
		$('#attachment2').val(''); 
		attachment_i++;
		$('#attachment').uploadify('disable',false);
		$('#attachment').uploadify('settings','uploadLimit',attachment_i);
		$.post('delete.php',{what:attachment_name});
		});
		$('.r_attachment').css("color","#9a9a9a");
	}   
		},//onsuccess结束	
		
	});
	
//标题验证
	$('#heading').bind('blur keyup focus',heading_check);
	function heading_check(){
		$('#to_upload').attr('disabled',true);
		mark3=0;
		var cur=$(this);
		var heading_length=cur.val().length;
		$('.r_heading').css("color","#9a9a9a");
		if(heading_length<1||heading_length>50)//无论汉子还是字母都站1字符
		{
			$('.r_heading').css("color","#F00");
		}
		else{
			$('.r_heading').css("color","#22cacc");
			mark3=1;
			if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
	}
//价格验证	
	$('#price').bind('blur keyup focus',price_check);
	function price_check(){
		mark4=0;
		$('#to_upload').attr('disabled',true);
		var cur=$(this);
		var reg=/\d{1,3}(\.\d{1,2})?$/
		$('.r_price').css("color","#9a9a9a");
		if(reg.test(cur.val())){
			if(cur.val()<1||cur.val()>100){
				$('.r_price').css("color","#F00");
			}
			else{
				$('.r_price').css("color","#22cacc");
				mark4=1;
				if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
					$('#to_upload').removeAttr('disabled');}
			}
		}
		else{
			$('.r_price').css("color","#F00");
		}
	}
//简介验证
	$('#summary').bind('blur keyup focus',summary_check);
	function summary_check(){
		$('.r_summary').css("color","#9a9a9a");
		$('#to_upload').attr('disabled',true);
		var cur=$(this);
		var summary_length=cur.val().length;
		if(summary_length>500){
			$('.r_summary').css("color","#F00");
		}
		else{
			$('.r_summary').css("color","#22cacc");
			if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
		if(summary_length==0){
			$('.r_summary').css("color","#9a9a9a");
		}
	}

//学校验证
	$('#school').bind('blur keyup focus',school_check);
	function school_check(){
		mark7=0;
		var cur=$(this);
		var school_length=cur.val().length;
		$('.r_school').css("color","#9a9a9a");
		if(school_length<1||school_length>30)//无论汉子还是字母都站1字符
		{
			$('#to_upload').attr('disabled',true);
			$('.r_school').css("color","#F00");
		}
		else
		{
			$('.r_school').css("color","#22cacc");
			mark7=1;
			if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
	}
//专业验证
	$('#subject').bind('blur keyup focus',subject_check);
	function subject_check(){
		mark8=0;
		var cur=$(this);
		var subject_length=cur.val().length;
		$('.r_subject').css("color","#9a9a9a");
		if(subject_length<1||subject_length>30)//无论汉子还是字母都站1字符
		{
			$('#to_upload').attr('disabled',true);
			$('.r_subject').css("color","#F00");
		}
		else
		{
			$('.r_subject').css("color","#22cacc");
			mark8=1;
			if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
	}

//书名验证
	$('#text_name').bind('blur keyup focus',text_name_check);
	function text_name_check(){
		mark9=0;mark11=0;
		var cur=$(this);
		var text_name_length=cur.val().length;
		$('.r_text').css("color","#9a9a9a");
		if(text_name_length<1||text_name_length>30)//无论汉子还是字母都站1字符
		{
			$('#to_upload').attr('disabled',true);
			$('.r_text').css("color","#F00");
			mark9=0;
		}
		else
		{
			mark9=1;
			if(mark9==0||mark10==0){
				$('.r_text').css("color","#F00");
			}
		}
		if(mark9==1&&mark10==1)
			{mark11=1;$('.r_text').css("color","#22cacc");
			}
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
	
//作者验证
	$('#text_author').bind('blur keyup focus',text_author_check);
	function text_author_check(){
		mark10=0;mark11=0;
		var cur=$(this);
		var text_author_length=cur.val().length;
		$('.r_text').css("color","#9a9a9a");
		if(text_author_length<1||text_author_length>20)//无论汉子还是字母都站1字符
		{
			$('#to_upload').attr('disabled',true);
			$('.r_text').css("color","#F00");
			mark10=0;
		}
		else
		{
			mark10=1;
			if(mark9==0||mark10==0){
				$('.r_text').css("color","#F00");
			}	
		}
		if(mark9==1&&mark10==1)
			{mark11=1;$('.r_text').css("color","#22cacc");
			}
		if(mark11==1&&mark8==1&&mark7==1&&mark6==1&&mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
	
});
</script>
</head>
<?php
require_once("../../repeat_code/nav.php");
require_once("../../repeat_code/member.php");
?>
<body>
<div id="frame">
<?php
if($_GET['new']==2){
//搜索专题信息
$query="SELECT a.class0,b.* ".
"FROM examination_category0 AS a ".
"INNER JOIN examination_category1 AS b ON(a.id=b.class0_id)".
"WHERE b.id=$_GET[category]";
$result=mysqli_query($dbc,$query) or die(数据库出现错误);
$row=mysqli_fetch_array($result);
}
//搜索专辑信息
$query2="SELECT * FROM examination_series WHERE user_id=$_SESSION[session_user_id]";
$result2=mysqli_query($dbc,$query2) or die(出错);
?>
	<div id="page">
		<div class="left">
			<p class="tittle">上传视频</p>
			<div class="select_file">
				<div class="video_con">
					<div id="video"></div>
				</div>
				<div id="video_queue"></div>
			</div>
			<p class="tittle">基本信息</p>
			<div id="series_update" class="infor_part" >
			<p class="tag_infor">*专辑信息</p>
<form id="upload_video" enctype="multipart/form-data" method="post" action="upload_three.php">
	<input type="hidden" name="video2" id="video2" value=""/>
	<input type="hidden" name="attachment2" id="attachment2" value=""/>
	<input type="hidden" name="title_picture" id="title_picture" value="<?php echo $_GET['id']?>"/><!--封面图片（隐藏）-->
	<input type="hidden" name="is_new" id="is_new" value="<?php echo $_GET['new']?>"/><!--专题判断-->
	<input type="hidden" name="is_free" id="is_free" value="<?php echo $_GET['free']?>"/><!--免费判断-->
	<input type="hidden" name="is_id" id="is_id" value="<?php echo $_GET['id']?>"/><!--选择图片判断-->
	<input type="hidden" name="series_title_picture2" id="series_title_picture2" value="<?php echo $_GET['id']?>"/><!--专辑封面图片，以所选教材图片代替-->
				<div class="ser_con">
					<div class="series_left">
	<input type="text" class="upload_input5" name="series_name" /><!--新建专辑标题-->
	<select class="upload_select" id="series" name="series">
		<option value="0">无</option>
<?php
//查询已建立的专辑，输出专辑id
	while($row2=mysqli_fetch_array($result2)){
		echo "<option value=".$row2['id'].">".$row2['series_name']."</option>";
	}
?>
	</select>
					</div>
					<div class="series_right">
						<a class="series_new_a">新建专辑</a>
						<button type="button" class="series_new_sub">确定</button>
						<button type="button" class="series_new_can_a">取消</button>
					</div>
					<div class="ser_che_con">
						<p id="series_check"></p>
					</div>
				</div>
			</div>
			<div id="cat_div" class="infor_part" >
				<p class="tag_infor">考试专题</p>
<?php
//判断是否为新建专题
if($_GET['new']==2){ 
?>
	<input type="text" id="cat_fir" class="upload_input4" disabled="disabled" value="<?php echo $row['class0']; ?>"/>
				<p class="cat_mid"> > </p>
	<input type="text" class="upload_input4" disabled="disabled" value="<?php echo $row['class1']; ?>"/>
	<input type="hidden" name="category" id="category" value="<?php echo $_GET['category']; ?>"/><!--输出专题id-->
<?php
}
if($_GET['new']==1){
?>
	<input type="text" id="cat1" class="upload_input4" name="cat1"/>
				<p class="cat_mid"> > </p>
	<input type="text" id="cat2" class="upload_input4" name="cat2"/>
<?php
}
?>
			</div><!--专题-->
			<div class="infor_part">
				<p class="tag_infor">标题</p>
	<input type="text" class="upload_input" id="heading" name="heading" value="" />
			</div><!--标题-->
			<div class="infor_part">
				<p class="tag_infor">价格</p>
	<input type="text" class="upload_input2" id="price" name="price"value="" /> 学币
			</div><!--价格-->
			<div class="infor_part">
				<p class="tag_infor">学校</p>
	<input type="text" class="upload_input6" id="school" name="school"value="" />
			</div>
			<div class="infor_part">
				<p class="tag_infor">专业</p>
	<input type="text" class="upload_input7" id="subject" name="subject"value="" />
			</div>
<?php
//判断是否选择图片
if($_GET['id']==11){
?>
			<div class="infor_part">
				<p class="tag_infor">教材信息</p>
				<p class="text_name_p">名字及版次</p>
	<input type="text" class="upload_input8" id="text_name" name="text_name"value="" />
				<p class="text_author_p">作者</p>
	<input type="text" class="upload_input9" id="text_author" name="text_author"value="" />
			</div>
<?php
}
?>
			<div class="infor_part">
				<p class="tag_infor">视频简介</p>
	<textarea class="upload_input3" name="summary" id="summary"></textarea>
</form>
			</div><!--简介-->
			<div class="att">
				<p class="tag_infor">附件（可选）</p>
				<div class="att_con">
					<div id="attachment"></div>
				</div>
				<div id="att_queue"></div>
			</div>
		</div><!--left-->
		<div class="right">
			<p class="tittle">要求</p>
<?php
//判断是否为免费视频
if($_GET['free']==2){
?>
			<P class="right_sel r_video">请上传视频文件，允许格式：swf,flv且小于150MB</P>
<?php
}
if($_GET['free']==1){
			?>
			<P class="right_sel r_video">请上传视频文件，允许格式：mp4且小于1GB</P>
<?php
}
?>	
			<p class="right_sel r_series">请选择是否将该教程纳入专辑</p>
			<p class="right_sel r_category">请选择教程专题，格式例如 公共基础课 > 高等数学</p>
			<p class="right_sel r_heading">请输入1至50个汉字或字符</p>
		<?php	
	if($_GET['free']==2){
?>		
			<p class="right_sel r_price">请输入价格，范围1~100</p>
	<?php
}
if($_GET['free']==1){
			?>		
			<p class="right_sel r_price">免费视频，价格为0，无法更改</p>
			<?php
}
?>	
			<p class="right_sel r_school">请输入1至30个汉字或字符</p>
			<p class="right_sel r_subject">请输入1至30个汉字或字符</p>
<?php
//判断是否选择图片
if($_GET['id']==11){
?>
			<p class="right_sel r_text">请输入1至30个汉字或字符</p>
<?php
}
?>
			<p class="right_sel r_summary">（可选填）请输入教程简介(500字之内)</p>
			<p class="right_sel r_attachment">（可选）请上传与教程相关的附件，如模型文件，ppt等，请压缩后上传，允许格式：rar,zip且小于50M</p>
		</div><!--right--><!--要求-->
<button type="button" id="to_upload" disabled="disabled" class="next_button">确 定</button>
	</div><!--page-->
</div><!--frame-->
<?php 
require_once("../../repeat_code/footer.php");
?>
</body>
</html>