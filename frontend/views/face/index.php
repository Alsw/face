<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\assets\AppAsset;

AppAsset::addCss($this, 'css/findme.css');
AppAsset::addJs($this, 'js/findme.js');
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
            <div class="compare">
                <h2>功能演示</h2>
                <p>
                 想知道你跟他人的相识程度，请上传照片,体验一下人脸比对能力
                </p>
                <div class="compare-left">
                     <div class="compare-box">
                        <div class="hand-img img-box">
                            <img id="img-one" src="images/4.jpg" alt="">
                        </div>
                    </div>
                    <div class="search-box">
                         <lable for="file-uploader" class="upload-img"><i class="icons icon-upload"></i><span>本地上传</span>
                            <input type="file" accept="image/png,image/jpeg" id="file-uploader-one" class="file-uploader">
                        </lable>
                        <button class="search-btn search-btn-one">添加</button>
                        <input placeholder="图片URL" class="search-input search-input-one">
                    </div>
                </div>
                <div class="compare-right">
                     <div class="compare-box">
                        <div class="hand-img img-box">
                            <img id="img-two" src="images/3.jpg" alt="">
                        </div>
                    </div>
                    <div class="search-box">
                         <lable for="file-uploader" class="upload-img"><i class="icons icon-upload"></i><span>本地上传</span>
                            <input type="file" accept="image/png,image/jpeg" id="file-uploader-two" class="file-uploader">
                        </lable>
                        <button class="search-btn search-btn-two">添加</button>
                         <input placeholder="图片URL" class="search-input search-input-two">
                    </div>
                </div>
                <div class="compare-result result-box">
                    <h2>比对结果</h2>
                    
                    <p class="result-one"></p>
                    <p class="result-two"></p>
                    <p class="result-desc"></p>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>