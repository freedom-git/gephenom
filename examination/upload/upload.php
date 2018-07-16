<?php
require_once("../../repeat_code/head.php");
require_once("../../repeat_code/member.php");
?>
<title>上传大学课程</title>
<link rel="stylesheet" href="upload.css">
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
        <h1>上传>大学课程</h1>
        <div class="tow">
          <p id="personal_2" class="tow_p"><a href="/tutorial/upload/upload.php">上传软件教程</a></p>
          <p id="personal_2" class="tow_p"><a href="/key/upload/upload.php">上传学习资料</a></p>
        </div>
      </div>
      <!--end_left_select--> 
    </div>
    <div class="right">
      <div id="container">
        <div id="example">
          <div id="slides">
            <div class="slides_container">
              <div class="slide"> <a href="http://115.28.242.176/" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-1.jpg" width="820" height="270" alt="Slide 1"></a>
                <div class="caption" style="bottom:0">
                  <p>Happy Bokeh Thursday!</p>
                </div>
              </div>
              <div class="slide"> <a href="http://115.28.242.176/" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-2.jpg" width="820" height="270" alt="Slide 2"></a>
                <div class="caption">
                  <p>Taxi</p>
                </div>
              </div>
              <div class="slide"> <a href="http://115.28.242.176/" title="Happy Bokeh raining Day | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-3.jpg" width="820" height="270" alt="Slide 3"></a>
                <div class="caption">
                  <p>Happy Bokeh raining Day</p>
                </div>
              </div>
              <div class="slide"> <a href="http://115.28.242.176/" title="We Eat Light | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-4.jpg" width="820" height="270" alt="Slide 4"></a>
                <div class="caption">
                  <p>We Eat Light</p>
                </div>
              </div>
              <div class="slide"> <a href="http://115.28.242.176/" title="&ldquo;I must go down to the sea again, to the lonely sea and the sky; and all I ask is a tall ship and a star to steer her by.&rdquo; | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-5.jpg" width="820" height="270" alt="Slide 5"></a>
                <div class="caption">
                  <p>&ldquo;I must go down to the sea again, to the lonely sea and the sky...&rdquo;</p>
                </div>
              </div>
              <div class="slide"> <a href="http://www.17sucai.com/" title="twelve.inch | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-6.jpg" width="820" height="270" alt="Slide 6"></a>
                <div class="caption">
                  <p>twelve.inch</p>
                </div>
              </div>
              <div class="slide"> <a href="http://www.17sucai.com/" title="Save my love for loneliness | Flickr - Photo Sharing!" target="_blank"><img src="img/slide-7.jpg" width="820" height="270" alt="Slide 7"></a>
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
          <div class="sel_free sel_hover"> <a href="upload_one.php?free=1">上传免费课程</a> </div>
          <div class="sel_pay sel_hover"> <a href="upload_one.php?free=2">上传付费课程</a> </div>
        </div>
      </div>
      <!--one_container--> 
    </div>
  </div>
</div>
<!--page-->
<?php 
require_once("../../repeat_code/footer.php");
?>
</body>
</html>
