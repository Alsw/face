<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::addJs($this, '@web/js/jquery.flexslider.js');
AppAsset::addCss($this, '@web/css/flexslider.css')
?>

<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="index.html"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">个人主页</li>
            </ul>
        </div>
        <div class="profile">
            <div class="col-md-12 ">
                <div class="col_3">
                    <div class="col-sm-2 row_2"> 
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="images/p1.jpg">
                                    <img src="images/p1.jpg" />
                                </li>
                                <li data-thumb="images/p1.jpg">
                                    <img src="images/p1.jpg" />
                                </li>
                                <li data-thumb="images/p1.jpg">
                                    <img src="images/p1.jpg" />
                                </li>
                                <li data-thumb="images/p1.jpg">
                                    <img src="images/p1.jpg" />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 row_1">
                        <h2>王小明</h2>
                        <table class="table_working_hours">
                            <tbody>
                                <tr class="opened">
                                    <td class="day_label">性别</td>
                                    <td class="day_value">女</td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label">所在行业</td>
                                    <td class="day_value">汽车</td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label">个人简介</td>
                                    <td class="day_value">没有正能量</td>
                                </tr>
                                <tr class="opened">
                                </tr>
                                <tr class="opened">
                                    <td class="day_label">个人标签</td>
                                    <td class="day_value">吃喝玩乐</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-3 "></div>
                    <div class="col-sm-3 ">
                        <input type="button" name="" value="+ 关注" id="guanzhu">
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-8 profile_left">
                <div class="col_4">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">动态</a></li>
                            <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">相册</a></li>
                            <li role="presentation"><a href="#profile1" role="tab" id="profile-tab1" data-toggle="tab" aria-controls="profile1">话题</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div class="tab_box">
                                    <h1>1，标题</h1>
                                    <p>内容简略。。。。</p>
                                    <a href="#">查看详细</a>
                                </div>
                                <div class="tab_box">
                                    <h1>2，标题</h1>
                                    <p>内容简略。。。。</p>
                                    <a href="#">查看详细</a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                <div class="basic_3">
                                    <h4>关注话题</h4>
                                    <div class="basic_1 basic_2">
                                        <div class="col-md-6 basic_1-left">
                                            <table class="table_working_hours">
                                                <tbody>
                                                    <tr class="opened">
                                                        <td class="day_label">人脸识别</td>
                                                    </tr>
                                                    <tr class="opened">
                                                        <td class="day_label">人工智能</td>
                                                    </tr>
                                                    <tr class="opened">
                                                        <td class="day_label">社交网络</td>
                                                    </tr>
                                                    <tr class="opened">
                                                        <td class="day_label">计算机</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile1" aria-labelledby="profile-tab1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 profile_right">
                <div class="view_profile">
                    <h3>相似的人</h3>
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/p5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>name</h4>
                                <p>个人标签</p>
                                <h5>1234567789</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/p5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>name</h4>
                                <p>个人标签</p>
                                <h5>1234567789</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/p5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>name</h4>
                                <p>个人标签</p>
                                <h5>1234567789</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="view_profile view_profile1">
                    <h3>关注者   10</h3>
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/p5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>name</h4>
                                <p>个人标签</p>
                                <h5>1234567789</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/p5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>name</h4>
                                <p>个人标签</p>
                                <h5>1234567789</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/p5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>name</h4>
                                <p>个人标签</p>
                                <h5>1234567789</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script>
$(window).load(function() {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });
});
</script>
