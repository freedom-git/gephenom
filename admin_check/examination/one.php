<?php
require_once("../../repeat_code/session_start.php");//包含会话开始文件
require_once("../../repeat_code/mysqli_connect.php");//包含数据库连接文件
require_once("../../repeat_code/manage_head.php");
?>
<?php
if(isset($_GET['category'])){$category_id=$_GET['category'];}else{exit;}
$query="SELECT * FROM examination_category1 WHERE id='$category_id' LIMIT 1";
$result=mysqli_query($dbc,$query) or die('出错');
$row=mysqli_fetch_array($result);
$query1="SELECT * FROM examination_category0 WHERE id='$row[class0_id]' LIMIT 1";
$result1=mysqli_query($dbc,$query1) or die('出错');
$row1=mysqli_fetch_array($result1);
$query2="SELECT * FROM examination_category1 WHERE class0_id='$row1[id]'";
$result2=mysqli_query($dbc,$query2) or die('出错');
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row1['class0'];?>><?php echo $row['class1'];?></title>
<link rel="stylesheet" href="one.css">
<link href="/css/share.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/slides.min.jquery.js"></script>
<script>
$(function(){
	$('#slides').slides({
		preload: true,
		preloadImage: 'img/loading.gif',
		play: 3500,
		pause: 2500,
		hoverPause: true,
		animationStart: function(current){
			$('.caption').animate({
				bottom:-35
			},100);
			if (window.console && console.log) {
				// example return of current slide number
				console.log('animationStart on slide: ', current);
			};
		},
		animationComplete: function(current){
			$('.caption').animate({
				bottom:0
			},200);
			if (window.console && console.log) {
				// example return of current slide number
				console.log('animationComplete on slide: ', current);
			};
		},
		slidesLoaded: function() {
			$('.caption').animate({
				bottom:0
			},200);
		}
	});
});
</script>
</head>
<body>
<?php
require_once("../../repeat_code/nav.php");
?>
<div id="page">
  <div class="one_con">
    <div class="left">
        <div class="left_select">
            <h1><?php echo $row1['class0'];?>><?php echo $row['class1'];?></h1>
            <div class="tow">
            <?php
			while($row2=mysqli_fetch_array($result2)) 
			{
			   ?>
               <p id="personal_2" class="tow_p"><a href="one.php?category=<?php echo $row2['id'];?>"><?php echo $row2['class1'];?></a></p>
               <?php
				}
			?>
            </div>

   </div>  <!--end_left_select-->
    </div>
    <div class="right">
      <div id="container">
		<div id="example">
			
			<div id="slides">
				<div class="slides_container">
					<div class="slide">
						<a href="http://115.28.242.176/" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-1.jpg" width="820" height="270" alt="Slide 1"></a>
						<div class="caption" style="bottom:0">
							<p>Happy Bokeh Thursday!</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://115.28.242.176/" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-2.jpg" width="820" height="270" alt="Slide 2"></a>
						<div class="caption">
							<p>Taxi</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://115.28.242.176/" title="Happy Bokeh raining Day | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-3.jpg" width="820" height="270" alt="Slide 3"></a>
						<div class="caption">
							<p>Happy Bokeh raining Day</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://115.28.242.176/" title="We Eat Light | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-4.jpg" width="820" height="270" alt="Slide 4"></a>
						<div class="caption">
							<p>We Eat Light</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://115.28.242.176/" title="&ldquo;I must go down to the sea again, to the lonely sea and the sky; and all I ask is a tall ship and a star to steer her by.&rdquo; | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-5.jpg" width="820" height="270" alt="Slide 5"></a>
						<div class="caption">
							<p>&ldquo;I must go down to the sea again, to the lonely sea and the sky...&rdquo;</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://www.17sucai.com/" title="twelve.inch | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-6.jpg" width="820" height="270" alt="Slide 6"></a>
						<div class="caption">
							<p>twelve.inch</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://www.17sucai.com/" title="Save my love for loneliness | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-7.jpg" width="820" height="270" alt="Slide 7"></a>
						<div class="caption">
							<p>Save my love for loneliness</p>
						</div>
					</div>
				</div>
				
                  
			</div>
			
		</div>
		
		
	</div>
      <div class="one_container">
          <div class="one_sel">
              <div class="sel_free sel_hover">
                   <a href="upload/upload.php">上传大学课程</a>
              </div>
              <div class="sel_pay sel_hover">
                    <a href="video_topics.php?category=<?php echo $_GET['category'];?>">观看大学课程</a>
              </div>
          </div>
      </div><!--one_container-->
    </div>
  </div>
</div><!--page-->
</body>
</html>
