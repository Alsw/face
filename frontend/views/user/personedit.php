<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use common\widgets\file_upload\FileUpload; 


AppAsset::addJs($this, 'js/jquery.flexslider.js');
AppAsset::addCss($this, 'css/flexslider.css')
?>
<style type="text/css">
    .per_real_img{
        width: 100px;
        height: 100px;
    }
    .per_upload_img{
        width: 100px;
        height: 100px;
    } 
    .personEdit{
        padding: 10px 5px;
        border-bottom: 1px solid #f0f2f7;

    }
</style>
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
                        <h2><?= Html::encode($model['user']->username) ?></h2>
                        <?php $form = ActiveForm::begin(['action' => ['user/personupdate'],'method'=>'post']); ?>
                         <div class="personEdit">
                               <?= $form->field($model['user'], 'sex')->textInput()->label('性别')->radioList(['男'=>'男','女'=>'女']) ?>
                        </div>
                        <div class="personEdit">
                                <?= $form->field($model['user'], 'avatar')->widget('common\widgets\file_upload\FileUpload')->label('用户头像') ?>
                        </div>
                        <div class="personEdit">
                                <?= $form->field($model['user'], 'introduce')->textarea(['rows'=>4])->label('个人简介') ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('确认', ['class' =>'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>


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
