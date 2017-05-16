<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\assets\AppAsset;

AppAsset::addCss($this, 'css/findme.css');
AppAsset::addJs($this, 'js/kai.js');
?>
<div class="grid_3">
        <div class="container">
            <div class="breadcrumb1">
                <ul>
                    <a href="index.html"><i class="fa fa-home home_1"></i></a>
                    <span class="divider">&nbsp;|&nbsp;</span>
                    <li class="current-page">FindMe</li>
                </ul>
            </div>
            <div class="container-fluid">
                <div class="compare row">
                    <h2>功能演示</h2>
                    <p>
                     寻找身边的名人，与系统定义的20000余人脸进行对比。
                    </p>
                    <p>
                        请用谷歌浏览器，目前兼容性比较差，手机版本正在开发。
                    </p>
                    <div class="compare-left col-xs-12 col-sm-8 col-md-6">
                        <div class="compare-box">
                            <div class="hand-img img-box">
                                <img id="img-zero" src="images/demo.jpg" alt="">
                            </div>
                        </div>
                        <div class="search-box">
                            <lable for="file-uploader" class="upload-img"><i class="icons icon-upload"></i><span>本地上传</span>
                                <input type="file" accept="image/png,image/jpeg" id="file-uploader-zero" class="file-uploader">
                            </lable>
                            <button class="search-btn search-btn-zero">添加</button>
                            <input placeholder="图片URL" class="search-input search-input-zero">
                        </div>
                    </div>
                    <div class="compare-result result-box col-xs-12 col-sm-4 col-md-6">
                        <h2>比对结果</h2>
                        
                        <p class="result-zero"></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
</div>

