<?php
require_once("../repeat_code/mysqli_connect.php");
if(isset($_GET['id'])){$id=mysqli_real_escape_string($dbc,trim($_GET['id']));}else{exit;}
if($id==1){$name='上传指导：屏幕录制软件的下载和安装';}
if($id==2){$name='上传指导：设置录制参数及课程的后期处理';}
if($id==3){$name='上传指导：生成免费课程文件';}
if($id==4){$name='上传指导：生成付费课程文件';}
if($id==5){$name='上传指导：录制大学课程的方法—手写ppt';}
if($id==7){$name='上传指导：上传软件教程';}
if($id==8){$name='上传指导：上传大学课程';}
if($id==9){$name='上传指导：上传学习资料';}

?>

   

     <div class="right_count">
         <p class="p_tittle"><?php echo $name;?></p>
            <div id="player">
           
             <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="800" height="624">
		<param name="movie" value="/tutorial/tutorials/player.swf" />
		<param name="allowfullscreen" value="true" />
		<param name="allowscriptaccess" value="always" />
		<param name="flashvars" value="file=/help/videos/<?php echo $id;?>.flv" />
		<embed
			type="application/x-shockwave-flash"
			id="player2"
			name="player2"
			src="/tutorial/tutorials/player.swf" 
			width="800" 
			height="624"
			allowscriptaccess="always" 
			allowfullscreen="true"
			flashvars="file=/help/videos/<?php echo $id;?>.flv" 
		/>
        
	</object>
			 </div>
             
         <?php if($id==1){?><a href="/help/attachment/<?php echo $name;?>.rar"><div class="display_ads">下载附件</div></a>
<?php }?>  
     </div>  <!--end_right_count-->
     
