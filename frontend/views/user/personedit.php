<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use common\widgets\file_upload\FileUpload; 


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
                        <h2><?= Html::encode($model['user']->username) ?></h2>
                        <?php $form = ActiveForm::begin(['action' => ['user/personupdate'],'method'=>'post']); ?>
                        <div class="personEdit">

                            <dl>
                                <?= $form->field($model['user'], 'avatar')->widget('common\widgets\file_upload\FileUpload')->label('用户头像') ?>
                            </dl>
                        </div>
                          <div class="personEdit">
                            <dl>
                                <?= $form->field($model['user'], 'introduce')->textarea(['rows'=>4])->label('个人简介') ?>
                            </dl>
                            
                        </div>
                       <!--  <?php  foreach ($model['userImg'] as $value):?>
                            <?php var_dump($value) ?>
                            <div class="personEdit">
                                <dl>
                                    <?= $form->field($value, 'imgPath')->widget('common\widgets\file_upload\FileUpload')->label('用户展示') ?>
                                </dl>
                            </div>
                        <?php endforeach;?> -->
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
