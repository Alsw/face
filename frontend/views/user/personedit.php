<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::addJs($this, 'js/jquery.flexslider.js');
AppAsset::addCss($this, 'css/flexslider.css')
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
                    <div class="col-sm-10 row_1">
                        <h2><?= Html::encode($model->username) ?></h2>
                        <div class="personEdit">
                            <dl>
                                <dt>性别</dt>
                                <dd>未知</dd>   
                            </dl>

                        </div>
                         <div class="personEdit">
                            <dl>
                                <dt>性别</dt>
                                <dd>未知</dd>   
                            </dl>
                            
                        </div>
                         <div class="personEdit">
                            <dl>
                                <dt>性别</dt>
                                <dd>未知</dd>   
                            </dl>
                            
                        </div>
                         <div class="personEdit">
                            <dl>
                                <dt>性别</dt>
                                <dd>未知</dd>   
                            </dl>
                            
                        </div>
                         <div class="personEdit">
                            <dl>
                                <dt>性别</dt>
                                <dd>未知</dd>   
                            </dl>
                            
                        </div>
                    </div>
                    </div>

                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-8 profile_left">
               
            </div>
            <div class="col-md-4 profile_right">
               
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<?php 
AppAsset::addJs($this, 'js/me.js');
?>
