<?php
require_once("../../repeat_code/session_start.php");
require_once("../../repeat_code/head.php");
require_once("../../repeat_code/function.php");
unset($_SESSION['t_mark']);
$video_random_name=guid().date('Y-m-d-H-i-s',time());
$title_picture_random_name=guid().date('Y-m-d-H-i-s',time());
$upload_picture_random_name=guid().date('Y-m-d-H-i-s',time());
$attachment_random_name=guid().date('Y-m-d-H-i-s',time());
$series_picture_random_name=guid().date('Y-m-d-H-i-s',time());
?>
<title>上传视频教程</title>
<link type="text/css" rel="stylesheet" href="upload_two.css"/>
<link href="/uploadify/uploadify2.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var video_i=1;//视频上传数量限制
	var tit_pic_i=1;//封面截图上传数量限制
	var up_pic_i=5;//截图上传数量限制
	var up_pic_i2=1;//截图次序
	var attachment_i=1;//附件上传数量限制
	var ser_pic_i=1;//专辑封面截图
	var mark1;//视频控制变量
	var mark2;//封面截图
	var mark3;//标题
	var mark4;//价格
	var mark6=1;//新建专辑
	var ser_pic_mark1=0;//新建专辑输入
	var ser_pic_mark2=0;//新建专辑上传截图
	var mark5;//专题
	var cat_mark1=0;//专题类别1
	var cat_mark2=0;//专题类别2
	
//初始设置
	$('#to_upload').click(function(){$('#upload_video').submit();});
	$('#series_picture_infor').hide();
	$('.upload_input5').hide();
	$('.series_new_can_a').hide();
	$('.series_new_sub').hide();
<?php
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
			
			if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
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
			
			if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	}
//专题验证结束
	var series_picture_name;
//专辑取消按钮
	$('.series_new_can_a').click(function(){
		mark6=1;
		$('.r_series').css("margin-top","110px");
		$('.r_series').html('请选择是否将该教程纳入专辑');
		$('.r_category').css("margin-top","110px");
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		$('#series_picture').uploadify('cancel');
		$('.series_new_a').show();
		$('.upload_select').show();
		$('.upload_input5').hide();
		$('.series_new_can_a').hide();
		$('#series_check').hide();
		$('.series_new_sub').hide();
		$('#series_picture_infor').hide();
		$('.r_series').css("color","#9a9a9a");
		ser_pic_i++;
		$.post('delete.php',{what:series_picture_name});
		ser_pic_mark2=0;
		$('#series_picture').uploadify('settings','uploadLimit',ser_pic_i);
		$('#series_picture').uploadify('disable',false);
	});
//新建专辑按钮
	$('.series_new_a').click(function(){
		mark6=0;
		$('.r_series').css("margin-top","120px");
		$('.r_series').html('请输入1至30个汉字或字符，并上传专辑封面图，允许格式：png,gif,bmp,jpg,jpeg，tif且小于1MB');
		$('.r_category').css("margin-top","48px");
		$('.r_series').css("color","#F00");
		$('#to_upload').attr('disabled',true);
		$('.series_new_can_a').show();
		$('.series_new_a').hide();
		$('.upload_select').hide();
		$('.upload_input5').show();
		$('#series_check').show();
		$('.series_new_sub').show();
		$('#series_check').empty();
		$('#series_picture_infor').show();
		$('.series_new_sub').attr('disabled','disabled');
	});
//专辑提交按钮
	$('.series_new_sub').click(function(){
		mark6=1;
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
		$('#to_upload').removeAttr('disabled');}
		$('.r_series').css("margin-top","76px");
		$('.r_series').html('请选择是否将该教程纳入专辑');
		$('.r_series').css("color","#9a9a9a");
		$('.r_category').css("margin-top","110px");

		$('#series_check').hide();
		$('.upload_input5').hide();
		$('.series_new_sub').hide();
		$('.series_new_can_a').hide();
		$('.series_new_a').hide();
		$('#series_picture_infor').hide();
		var data2=$('#upload_video').serialize();
		$.post('series_sunmit.php',data2,function(series_name){
		$('.series_left').html(series_name)
		},'html');
	});
//专辑输入
	$('.upload_input5').bind('blur keyup focus',series_new);
	function series_new(){
		ser_pic_mark1=0;
		var data=$('.upload_input5').serialize();
		$.post('series_new.php',data,function(series_text){
		$('#series_check').html(series_text);
		if(series_text!='可用'){
			ser_pic_mark1=0;
			$('.series_new_sub').attr('disabled','disabled');
		}
		else{
			ser_pic_mark1=1;
		}
		if(ser_pic_mark1==1&&ser_pic_mark2==1){
			$('.series_new_sub').removeAttr('disabled');
		}
		},'html');		
	}
	
//专辑封面截图upload	
	$('#series_picture').uploadify({
		'fileObjName'	  :'series_picture',
		'swf'  	          :'/uploadify/uploadify.swf',
		'uploader'    	  :'movefile.php',
		'fileTypeDesc'    :'可选的文件类型',
		'fileTypeExts'    :'*.png;*.gif;*.bmp;*.jpg;*.jpeg;*.tif',
		'fileSizeLimit'	  :'1MB',
		'multi'			  :false,//同时间允许选取多个文件
		'uploadLimit'     :ser_pic_i,//允许上传的总数
		'removeCompleted'  :false,//上传完成后进度条是否消失
		'progressData'	  :'speed',
		'auto'			  :true,
		'formData'        :{'series_picture_random_name':'<?php echo $series_picture_random_name;?>'},
		//'buttonClass':'',//button的class
		'buttonText':'选择文件',
		//'checkExisting':'',//检查存在的后台路径
		//'height':'',
		//'width':'',
		//'itemTemplate' : '',
		//'overrideEvents':'',//不懂
		'queueID':'ser_pic_queue',//不懂
		'queueSizeLimit':1,//同时允许的最大上传数量 
		//'requeueErrors':'',//重复上传，出错时
		
		'onSelect':function(file){
			series_picture_name='<?php echo $series_picture_random_name;?>'+file.type;
			ser_pic_mark2=0;
			$('.series_new_sub').attr('disabled','disabled');
			$('.r_series').css("color","#F00");
			$('#series_picture').uploadify('disable',true);
			var cancel=$("#"+file.id + " .cancel a");  
			if (cancel) {  
				cancel.on('click',function () {  
				ser_pic_mark2=0;
				$('.r_series').css("color","#F00");
				$('.series_new_sub').attr('disabled',true);
				ser_pic_i++;
				$('#series_picture').uploadify('disable',false);
				$('#series_picture').uploadify('settings','uploadLimit',ser_pic_i);
				$.post('delete.php',{what:series_picture_name});
				});  
			}   
		},//onselect结束
	
		'onUploadSuccess' : function(file, data, response) {
			series_picture_name='<?php echo $series_picture_random_name;?>'+file.type;
			$('#series_picture2').val(series_picture_name);
			$('.r_series').css("color","#22cacc");
			ser_pic_mark2=1;
			if(ser_pic_mark1==1&&ser_pic_mark2==1){
				$('.series_new_sub').removeAttr('disabled');
			}
			var cancel=$("#"+file.id + " .cancel a");  
			if (cancel) {  
				cancel.on('click',function () {  
				ser_pic_mark2=0;
				$('.r_series').css("color","#F00");
				$('.series_new_sub').attr('disabled',true);
				ser_pic_i++;
				$('#series_picture').uploadify('disable',false);
				$('#series_picture').uploadify('settings','uploadLimit',ser_pic_i);
				$.post('delete.php',{what:series_picture_name});
				});  
			}   
		},//onsuccess结束	
	});	
	
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
		'uploadLimit'     : video_i,//允许上传的总数
		'removeCompleted' :false,//上传完成后进度条是否消失
		'progressData'	  :'speed',
		'auto'			  :true,
		'formData'        :{'video_random_name':'<?php echo $video_random_name;?>'},
		//'buttonClass':'video_but_cla',//button的class
		'buttonText'      :'选择文件',
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
			$.post('delete.php',{what:video_name,});
		});  
   }
			},//onselect结束
	
		'onUploadSuccess' : function(file, data, response) {
			
			var video_name='<?php echo $video_random_name;?>'+file.type;
			$('#video2').val(video_name);
			$('.r_video').css("color","#22cacc");
			mark1=1;
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	var cancel=$("#"+file.id + " .cancel a");  
    if (cancel) {  
		cancel.on('click',function () {  
			$('.r_video').css("color","#F00");
			$('#to_upload').attr('disabled',true);mark1=0;
			video_i++;
			$('#video').uploadify('disable',false);
			$('#video').uploadify('settings','uploadLimit',video_i);
			$.post('delete.php',{what:video_name,});
		});  
   }   
   },//onsuccess结束	
	});
	
	
//封面截图upload	
	$('#title_picture').uploadify({
		'fileObjName'	  :'title_picture',
		'swf'  	          :'/uploadify/uploadify.swf',
		'uploader'    	  :'movefile.php',
		'fileTypeDesc'    :'可选的文件类型',
		'fileTypeExts'    :'*.png;*.gif;*.bmp;*.jpg;*.jpeg;*.tif',
		'fileSizeLimit'	  :'1MB',
		'multi'			  :false,//同时间允许选取多个文件
		'uploadLimit'     : tit_pic_i,//允许上传的总数
		'removeCompleted' :false,//上传完成后进度条是否消失
		'progressData'	  :'speed',
		'auto'			  :true,
		'formData'		  :{'title_picture_random_name':'<?php echo $title_picture_random_name;?>'},
		//'buttonClass':'',//button的class
		'buttonText':'选择文件',
		//'checkExisting':'',//检查存在的后台路径
		//'height':'',
		//'width':'',
		//'itemTemplate' : '',
		//'overrideEvents':'',//不懂
		'queueID':'tit_pic_queue',//不懂
		'queueSizeLimit':1,//同时允许的最大上传数量 
		//'requeueErrors':'',//重复上传，出错时
		
		'onSelect':function(file){
			var title_picture_name='<?php echo $title_picture_random_name;?>'+file.type;
			$('#to_upload').attr('disabled',true);
			$('.r_tit_pic').css("color","#F00");
			$('#title_picture').uploadify('disable',true);
				var cancel=$("#"+file.id + " .cancel a");  
    if (cancel) {  
		cancel.on('click',function () {
		$('.r_tit_pic').css("color","#F00");
		$('#to_upload').attr('disabled',true);mark2=0;
		tit_pic_i++;
		$('#title_picture').uploadify('disable',false);
		$('#title_picture').uploadify('settings','uploadLimit',tit_pic_i);
		$.post('delete.php',{what:title_picture_name});
		});  
	}
			},//onselect结束
			
	
		'onUploadSuccess' : function(file, data, response) {
			var title_picture_name='<?php echo $title_picture_random_name;?>'+file.type;
			$('#title_picture2').val(title_picture_name);
			$('.r_tit_pic').css("color","#22cacc");
			mark2=1;
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
	var cancel=$("#"+file.id + " .cancel a");  
    if (cancel) {  
		cancel.on('click',function () { 
		$('.r_tit_pic').css("color","#F00");
		$('#to_upload').attr('disabled',true);mark2=0;
		tit_pic_i++;
		$('#title_picture').uploadify('disable',false);
		$('#title_picture').uploadify('settings','uploadLimit',tit_pic_i);
		$.post('delete.php',{what:title_picture_name});
		});  
	}   
	},//onsuccess结束	
	});
	
//截图upload
	$('#upload_picture2').val('');
	var upload_picture_array=new Array();
	var upload_picture_array2=new Array();
	var upload_picture_name_all;
	$('#upload_picture').uploadify({
		'fileObjName'	  :'upload_picture',
		'swf'  	          :'/uploadify/uploadify.swf',
		'uploader'    	  :'movefile.php',
		'fileTypeDesc'    :'可选的文件类型',
		'fileTypeExts'    :'*.png;*.gif;*.bmp;*.jpg;*.jpeg;*.tif',
		'fileSizeLimit'	  :'1MB',
		'multi'			  :true,//同时间允许选取多个文件
		'uploadLimit'     : up_pic_i,//允许上传的总数
		'removeCompleted'  :false,//上传完成后进度条是否消失
		'progressData'	  :'speed',
		'auto'			  :true,
		'formData':{'up_pic_order':up_pic_i2,
					'upload_picture_random_name':'<?php echo $upload_picture_random_name;?>'},
		//'buttonClass':'',//button的class
		'buttonText':'选择文件',
		//'checkExisting':'',//检查存在的后台路径
		//'height':'',
		//'width':'',
		//'itemTemplate' : '',
		//'overrideEvents':'',//不懂
		'queueID':'up_pic_queue',//不懂
		'queueSizeLimit':5,//同时允许的最大上传数量 
		//'requeueErrors':'',//重复上传，出错时
	'onSelect':function(file){
		var upload_picture_name='<?php echo $upload_picture_random_name;?>'+up_pic_i2+file.type;
		var cancel=$("#"+file.id + ".cancel a");  
		if (cancel){
		cancel.on('click',function () {
			for(var i=0;i<upload_picture_array.length;++i){
				upload_picture_name_all=upload_picture_array[i]+'*'+upload_picture_name_all;
			};
		$('#upload_picture2').val(upload_picture_name_all);
			up_pic_i++;
			$('#upload_picture').uploadify('settings','uploadLimit',up_pic_i);
			$.post('delete.php',{what:upload_picture_name});
		});  
		}
			},
	'onUploadSuccess' : function(file, data, response) {
		var upload_picture_name='<?php echo $upload_picture_random_name;?>'+up_pic_i2+file.type;
		upload_picture_array.push(upload_picture_name);
		upload_picture_name_all='';
		for(var i=0;i<upload_picture_array.length;++i){
				upload_picture_name_all=upload_picture_array[i]+'*'+upload_picture_name_all;
			};
		$('#upload_picture2').val(upload_picture_name_all);
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
			$('#to_upload').removeAttr('disabled');
		}
		
		up_pic_i2++;
		$("#upload_picture").uploadify("settings", 'formData',{'up_pic_order' : up_pic_i2});
		var cancel=$("#"+file.id + " .cancel a");  
		if (cancel) {  
		var up_pic_i3=up_pic_i2-1;
		cancel.on('click',function () {
			
			upload_picture_array2=[];
			for(var i=0;i<upload_picture_array.length;++i){
				if(upload_picture_array[i]!=upload_picture_name){
					upload_picture_array2.push(upload_picture_array[i]);
				};
			};
			
			upload_picture_array=upload_picture_array2;
			upload_picture_name_all='';
			for(var i=0;i<upload_picture_array.length;++i){
				upload_picture_name_all=upload_picture_array[i]+'*'+upload_picture_name_all;
			};
		$('#upload_picture2').val(upload_picture_name_all);
			up_pic_i++;
			$('#upload_picture').uploadify('settings','uploadLimit',up_pic_i);
			$.post('delete.php',{what:upload_picture_name});
		});  
		}   	  
        },//onsucess结束
	});
	
//attachment upload
	$('#attachment').uploadify({
		'fileObjName'	  :'attachment',
		'swf'  	          :'/uploadify/uploadify.swf',
		'uploader'    	  :'movefile.php',
		'fileTypeDesc'    :'可选的文件类型',
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
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
			}//点差按钮结束
		},//select结束
		'onUploadSuccess' : function(file, data, response) {
			
			var attachment_name='<?php echo $attachment_random_name;?>'+file.type;
			$('#attachment2').val(attachment_name);
			$('.r_attachment').css("color","#22cacc");
		if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
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
			if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
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
				if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
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
			if(mark6==1&&mark1==1&&mark2==1&&mark3==1&&mark4==1&&mark5==1){
				$('#to_upload').removeAttr('disabled');}
		}
		if(summary_length==0){
			$('.r_summary').css("color","#9a9a9a");
		}
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
//搜索专题信息
if($_GET['new']!=1){
$query="SELECT a.class0,b.* ".
"FROM tutorial_category0 AS a ".
"INNER JOIN tutorial_category1 AS b ON(a.id=b.class0_id)".
"WHERE b.id=$_GET[category]";
$result=mysqli_query($dbc,$query) or die(数据库出现错误);
$row=mysqli_fetch_array($result);
}
//搜索专辑信息
$query2="SELECT * FROM tutorial_series WHERE user_id=$_SESSION[session_user_id]";
$result2=mysqli_query($dbc,$query2) or die(出错);
?>
  <div id="page">
    <div class="left">
      <p class="tittle">上传教程</p>
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
	  <input type="hidden" name="series_picture2" id="series_picture2" value=""/>
      <input type="hidden" name="video2" id="video2" value=""/>
      <input type="hidden" name="title_picture2" id="title_picture2" value=""/>
	  <input type="hidden" name="upload_picture2" id="upload_picture2" value=""/>
	  <input type="hidden" name="attachment2" id="attachment2" value=""/>
	  <input type="hidden" name="is_new" id="is_new" value="<?php echo $_GET['new']?>"/><!--专题判断-->
	  <input type="hidden" name="is_free" id="is_free" value="<?php echo $_GET['free']?>"/><!--免费判断-->

	  <div class="ser_con">
      <div class="series_left">
	  <input type="text" class="upload_input5" name="series_new"  />
        <select class="upload_select" id="series" name="series">
          <option value="0">无</option>
          <?php
					while($row2=mysqli_fetch_array($result2)){
						echo "<option value=".$row2['id'].">".$row2['series_name']."</option>";
						}
					?>
                   
        </select>
        
        </div>
        <div class="series_right">
        <a class="series_new_a">新建专辑</a><button type="button" class="series_new_sub">确定</button><button type="button" class="series_new_can_a">取消</button>
        </div>
		<div class="ser_che_con">
		<p id="series_check"></p>
		</div>
		</div>
		
		
        
        <div id="series_picture_infor" class="infor_part" >
        <p class="tag_infor">专辑封面图片</p>
        	<div class="series_picture_con">
        			<div id="series_picture"></div>
       		 </div>
        	<div id="ser_pic_queue"></div>
        
        </div>
		</div>
        <div id="cat_div" class="infor_part" >
          <p class="tag_infor">*视频专题</p>
          <?php
						if($_GET['new']==2){ 
						?>
          <input type="text" id="cat_fir" class="upload_input4" disabled="disabled" value="<?php echo $row['class0']; ?>"/><p class="cat_mid"> > </p>
          <input type="text" class="upload_input4" disabled="disabled" value="<?php echo $row['class1']; ?>"/>
          <input type="hidden" name="category" id="category" value="<?php echo $_GET['category']; ?>"/>
          <?php
						}
						if($_GET['new']==1){
							?>
          <input type="text" id="cat1" class="upload_input4" name="cat1"/><p class="cat_mid"> > </p>
          <input type="text" id="cat2" class="upload_input4" name="cat2"/>
          <?php
						}
						?>
        </div>
        <!--专题-->
        <div class="infor_part">
          <p class="tag_infor">*标题</p>
          <input type="text" class="upload_input" id="heading" name="heading" value="" />
        </div>
        <!--标题-->
        <div class="infor_part">
          <p class="tag_infor">*价格</p>
          <input type="text" class="upload_input2" id="price" name="price"value="" /> 学币
        </div>
        <!--价格-->
        <div class="infor_part">
        <p class="tag_infor">视频简介</p>
        <textarea class="upload_input3" name="summary" id="summary"></textarea>
      </form>
    </div>
    <!--简介-->
    <div class="tit_pic">
      <p class="tag_infor">*上传教程封面图</p>
      <div class="tit_pic_con">
      <div id="title_picture"></div>
      </div>
      <div id="tit_pic_queue">
      </div>
    </div>
    
    <div class="up_pic">
      <p class="tag_infor">上传教程视频截图</p>
      <div class="up_pic_con">
      <div id="upload_picture"></div>
      </div>
      <div id="up_pic_queue"></div>
    </div>
    <div class="att">
      <p class="tag_infor">上传附件</p>
      <div class="att_con">
      <div id="attachment"></div>
      </div>
      <div id="att_queue"></div>
    </div>
  </div>
  <!--left-->
  <div class="right">
    <p class="tittle">要求</p>
		<?php
		if($_GET['free']==2){
			?>
    <P class="right_sel r_video">请上传视频文件，允许格式：swf且小于150MB</P>


			<?php
		}
		?>	
<?php
		if($_GET['free']==1){
			?>
    <P class="right_sel r_video">请上传视频文件，允许格式：mp4且小于1000MB</P>
			<?php
		}
		?>	

	
    <p class="right_sel r_series">请选择是否将该教程纳入专辑</p>
    <p class="right_sel r_category">请选择教程专题，格式例如 信息化办公 > word</p>
    <p class="right_sel r_heading">请输入1至50个汉字或字符</p>
<?php
		if($_GET['free']==1){
			?>
    <p class="right_sel r_price">免费视频，价格为0，无法更改</p>
	<?php
		}
		if($_GET['free']==2){
			?>
			<p class="right_sel r_price">请输入价格，范围1~100</p>
			<?php
		}
		?>
    <p class="right_sel r_summary">（可选填）请输入教程简介(500字之内)</p>
    <p class="right_sel r_tit_pic">请上传视频封面图，允许格式：png,gif,bmp,jpg,jpeg，tif且小于1MB</p>
    <p class="right_sel r_up_pic">（可选）请上传视频截图（不多于5张），允许格式：png,gif,bmp,jpg,jpeg,tif且小于1MB</p>
    <p class="right_sel r_attachment">（可选）请上传与教程相关的附件，如模型文件，ppt等，请压缩后上传，允许格式：rar,zip且小于50M</p>
  </div>
  <!--right--><!--要求-->
  
  <button type="button" id="to_upload" disabled="disabled" class="next_button">确 定</button>
</div>
<!--page-->
</div>
<!--frame-->
<?php 
require_once("../../repeat_code/footer.php");
?>
</body>
</html>