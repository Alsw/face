<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::addJs($this, 'js/jquery.flexslider.js');
AppAsset::addCss($this, 'css/flexslider.css')；
AppAsset::addCss($this, 'css/person.css')
?>

<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="index.html"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">个人主页 </li>
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
                        <h2><?= Html::encode($model->username) ?></h2>
                        <table class="table_working_hours">
                            <tbody>
                                <tr class="opened">
                                    <td class="day_label">性别</td>
                                    <td class="day_value"><?= Html::encode($model->sex) ?></td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label">所在行业</td>
                                    <td class="day_value">汽车</td>
                                </tr>
                                <tr class="opened">
                                    <td class="day_label">个人简介</td>
                                    <td class="day_value"><?= Html::encode($model->introduce) ?></td>
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
                    <div class="col-sm-2 ">
                     <?= Html::a('+ 关注', ['user/personedit',],['class' => 'guanzhu']) ?>
                    </div>

                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-8 profile_left">
                <div class="col_4">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" ">动态</a></li> 
                            <li role="presentation" ><a href="#home" id="home-tab" ">回答</a></li>
                            <li role="presentation" ><a href="#home" id="home-tab" ">话题</a></li> 
                            <li role="presentation" ><a href="#home" id="home-tab" ">关注</a></li>
                            <li role="presentation" ><a href="#home" id="home-tab" ">相册</a></li>
                        </ul>
                        <?= $this->render('person-show') ?>
                    </div>
                </div>
            </div>
            
             <?= $this->render('person-like') ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<?php 
AppAsset::addJs($this, 'js/me.js');
?>
