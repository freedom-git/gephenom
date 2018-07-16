<div class="site-info-w">
    <div class="site-info">
        <div class="site-info__item">
            <h3>获取更新</h3>
            <ul>
                <li><a rel="nofollow" href="http://weibo.com/5124100511" target="_blank">聚峰新浪微博</a></li>
                <li><a rel="nofollow" href="http://page.renren.com/601880049" target="_blank">聚峰人人主页</a></li>
                <li><a rel="nofollow" href="http://t.qq.com/gephenom
" target="_blank">聚峰腾讯微博</a></li>                
                <li><a rel="nofollow" href="http://user.qzone.qq.com/2089117167" target="_blank">聚峰QQ空间</a></li>
            </ul>
        </div>
        <div class="site-info__item">
            <h3>商务合作</h3>
            <ul>
                <li><a rel="nofollow" href="#">联系聚峰</a></li>
            </ul>
        </div>
        <div class="site-info__item">
            <h3>网站信息</h3>
            <ul>
                <li><a rel="nofollow" href="#">关于聚峰</a></li>
                <li><a rel="nofollow" href="#">加入我们</a></li>
                <li><a rel="nofollow" href="#">法律声明</a></li>
                <li><a rel="nofollow" href="#">用户协议</a></li>
            </ul>
        </div>
        <div class="site-info__item">
            <h3>用户帮助</h3>
            <ul>
                <li><a rel="nofollow" href="/help/display.php?id=1">新手帮助</a></li>
                <li><a rel="nofollow" href="/help/display.php?id=2">上传指导</a></li>
                <li><a rel="nofollow" href="/personal_index/personal_index.php">充值/提现</a></li>
                <li><a rel="nofollow" href="/login/login.php">注册/登录</a></li>
            </ul>
        </div>
        <div class="site-info__item site-info__item--service">
            <h3>意见反馈</h3>
            <div class="contact-info">
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=401048056&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:401048056:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
            </div>
        </div>
        
        <div class="copyright">
<!--            <p>©2014<a href="http://gephenom.com/">聚云峰</a> gephenom.com <a href="http://www.miitbeian.gov.cn/" target="_blank">吉ICP备14001553号</a></p>-->
            <div style="width:300px;margin:0 auto; padding:20px 0;">
                <img src="../image/gonganbubeian.png"><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=14030202000102" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">晋公网安备 14030202000102号</p></a>
            </div>
        </div>
        </div>
</div>
<?php
//mysqli_close($dbc);
?>
<?php
//检测ie6
if($_SESSION['IE6']!=1&&strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0') !== false )
{
   echo '<script type="text/javascript">
alert("对不起，本网站不支持IE6为内核的浏览器，请更换浏览器，谢谢");
</script>';
$_SESSION['IE6']=1;
}
?>
<!--BAIDU_YUNTU_START-->
<script>
(function(d, t) {
    var r = d.createElement(t), s = d.getElementsByTagName(t)[0];
    r.async = 1;
    r.src = '//rp.baidu.com/rp3w/3w.js?sid=4617957809123279748&t=' + Math.ceil(new Date/3600000);
    s.parentNode.insertBefore(r, s);
})(document, 'script');
</script>
<!--BAIDU_YUNTU_END-->