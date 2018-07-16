<?php
require_once("../../repeat_code/session_start.php");
require_once("../../repeat_code/head.php");
require_once("../../repeat_code/function.php");
unset($_SESSION['k_mark']);
$video_random_name=guid().date('Y-m-d-H-i-s',time());
?>
<link rel="stylesheet" type="text/css" href="../../uploadify/uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
<title>上传学习资料</title>
<link type="text/css" rel="stylesheet" href="upload_two.css"/>
<link href="/uploadify/uploadify2.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var video_i=1;//视频上传数量限制
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
	var mark12;//书名空
	var mark13;//作者空
//初始设置
	$('#to_upload').click(function(){$('#upload_video').submit();});
	$('.upload_input5').hide();
<?php
//已选择图片
if($_GET['id']!=11){
?>
	mark11=1;
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
			
			if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
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
			
			if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
//专题验证结束

//视频upload
	$('#video').uploadify({
		'fileObjName'	  :'video',
		'swf'  	          :'/uploadify/uploadify.swf',
		'uploader'    	  :'movefile.php',
		'fileTypeDesc'    :'可选的文件类型',
		'fileTypeExts'    :'*.rar;*.zip;',
		'fileSizeLimit'	  :'50MB',
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
		if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
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
			if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
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
			if(cur.val()<1||cur.val()>20){
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
			if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
		if(summary_length==0){
			$('.r_summary').css("color","#9a9a9a");
		}
	}
	
//学校验证
	$('#school').bind('blur keyup focus',school_check);
	function school_check(){
		$('#to_upload').attr('disabled',true);
		var cur=$(this);
		var school_length=cur.val().length;
		$('.r_school').css("color","#9a9a9a");
		if(school_length<1||school_length>30)//无论汉子还是字母都站1字符
		{
			$('.r_school').css("color","#F00");
		}
		else
		{
			$('.r_school').css("color","#22cacc");
			if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
		if(school_length==0){
			$('.r_school').css("color","#9a9a9a");
		}

	}
	
//专业验证
	$('#subject').bind('blur keyup focus',subject_check);
	function subject_check(){
		$('#to_upload').attr('disabled',true);
		var cur=$(this);
		var subject_length=cur.val().length;
		$('.r_subject').css("color","#9a9a9a");
		if(subject_length<1||subject_length>30)//无论汉子还是字母都站1字符
		{
			$('.r_subject').css("color","#F00");
		}
		else
		{
			$('.r_subject').css("color","#22cacc");
			if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
		if(subject_length==0){
			$('.r_subject').css("color","#9a9a9a");
		}
	}

//书名验证
	$('#text_name').bind('blur keyup focus',text_name_check);
	function text_name_check(){
		mark9=0;mark12=0;
		$('#to_upload').attr('disabled',true);
		var cur=$(this);
		var text_name_length=cur.val().length;
		$('.r_text').css("color","#9a9a9a");
		if(text_name_length<1||text_name_length>30)//无论汉子还是字母都站1字符
		{
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
		if(text_name_length==0){
			mark12=1;
		}
		if(mark9==1&&mark10==1){
			$('.r_text').css("color","#22cacc");
		}
		if(mark12==1&&mark13==1){
			$('.r_text').css("color","#9a9a9a");
		}
		if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
	
//作者验证
	$('#text_author').bind('blur keyup focus',text_author_check);
	function text_author_check(){
		mark10=0;mark13=0;
		$('#to_upload').attr('disabled',true);
		var cur=$(this);
		var text_author_length=cur.val().length;
		$('.r_text').css("color","#9a9a9a");
		if(text_author_length<1||text_author_length>30)//无论汉子还是字母都站1字符
		{
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
		if(text_author_length==0){
			mark13=1;
		}
		if(mark9==1&&mark10==1){
			$('.r_text').css("color","#22cacc");
		}
		if(mark12==1&&mark13==1){
			$('.r_text').css("color","#9a9a9a");
		}

		if(mark1==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
	

});
</script>
</head>
<?php
require_once("../../repeat_code/nav.php");
require_once("../../repeat_code/member.php");
?>
<div id="frame">
<?php 
if($_GET['new']==2){
//搜索专题信息
$query="SELECT a.class0,b.* ".
"FROM solution_category0 AS a ".
"INNER JOIN solution_category1 AS b ON(a.id=b.class0_id)".
"WHERE b.id=$_GET[category]";
$result=mysqli_query($dbc,$query) or die(数据库出现错误);
$row=mysqli_fetch_array($result);
}
?>
	<div id="page">
		<div class="left">
			<p class="tittle">上传文件</p>
			<div class="select_file">
				<div class="video_con">
					<div id="video"></div>
				</div>
				<div id="video_queue"></div>
			</div>
			<p class="tittle">基本信息</p>
			<div class="infor_part" >
				<p class="tag_infor">学习资料专题</p>
<form id="upload_video" enctype="multipart/form-data" method="post" action="upload_three.php">
	<input type="hidden" name="title_picture" id="title_picture" value="<?php echo $_GET['id']?>"/><!--封面图片（隐藏）-->
	<input type="hidden" name="video2" id="video2" value=""/>
	<input type="hidden" name="is_new" id="is_new" value="<?php echo $_GET['new']?>"/><!--专题判断-->
	<input type="hidden" name="is_id" id="is_id" value="<?php echo $_GET['id']?>"/><!--选择图片判断-->

<?php
if($_GET['new']==2){
//判断是否为新建专题
?>
	<input type="text" id="cat_fir" class="upload_input4" disabled="disabled" value="<?php echo $row['class0']; ?>"/>
				<p class="cat_mid"> > </p>
	<input type="text" class="upload_input4" disabled="disabled" value="<?php echo $row['class1']; ?>"/>
	<input type="hidden" name="category" id="category" value="<?php echo $_GET['category']; ?>"/>
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
				<input type="text" class="upload_input2" id="price" name="price"value=" " /> 学币
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
				<p class="tag_infor">资料简介</p>
	<textarea class="upload_input3" name="summary" id="summary"></textarea>
</form>
			</div><!--简介--> 
		</div><!--left-->
		<div class="right">
			<p class="tittle">要求</p>
			<P class="right_sel r_video">请上传压缩后的学习资料文件，允许格式：rar,zip且小于50M</P>
			<p class="right_sel r_category">请选择学习资料专题，格式例如 公共基础课 > 高等数学</p>
			<p class="right_sel r_heading">请输入1至50个汉字或字符</p>
			<p class="right_sel r_price">请输入价格，范围1~20</p>
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
			<p class="right_sel r_summary">（可选填）请输入学习资料简介(500字之内)</p>
		</div><!--right--><!--要求-->
		<button type="button" id="to_upload" disabled="disabled" class="next_button">确 定</button>
	</div><!--page--> 
</div><!--frame-->
<?php 
require_once("../../repeat_code/footer.php");
?>
</body>
</html>