<?php
use yii\widgets\ActiveForm;
use common\widgets\file_upload\FileUpload; 
use common\widgets\ueditor\Ueditor; 
use common\widgets\tags\TagWidget;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::addJs($this, 'js/topic.js');
AppAsset::addCss($this, 'css/topic.css');
?>

 <div class="grid_3">
        <div class="container">
            <div class="breadcrumb1">
                <ul>
                    <a href="index.html"><i class="fa fa-home home_1"></i></a>
                    <span class="divider">&nbsp;|&nbsp;</span>
                    <li class="current-page">话题</li>
                </ul>
            </div>
            <div class="col-md-3 col_5">
                <ul class="menu">
                    <li class="item1">
                        <h3 class="m_2">按时间分类</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">一周内(8) </a></li>
                            <li class="subitem2"><a href="#">一月内(14)</a></li>
                        </ul>
                    </li>
                    <li class="item1">
                        <h3 class="m_2">人脸</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">人脸识别(2)</a></li>
                            <li class="subitem1"><a href="#">表情识别(5)</a></li>
                            <li class="subitem1"><a href="#">人脸检测(5)</a></li>
                            <li class="subitem1"><a href="#">人脸搜索(5)</a></li>
                        </ul>
                    </li>
                    <li class="item1">
                        <h3 class="m_2">智能</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">数据挖掘</a></li>
                            <li class="subitem1"><a href="#">神经网络</a></li>
                            <li class="subitem1"><a href="#">机器学习</a></li>
                        </ul>
                    </li>
                    <li class="item1">
                        <h3 class="m_2">资源共享</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">数据分享</a></li>
                            <li class="subitem1"><a href="#">源码共享</a></li>
                            <li class="subitem1"><a href="#">书籍推荐</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 members_box2">
                <div class="topic-top">
                	<h3>添加文章</h3>
                </div>

                <div class="col_4">
                  
                    <div class="article-form">

                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'title')->label('标题')->textInput(['maxlength' => true]) ?>
                        
                        <?= $form->field($model, 'parentId')->label('栏目')->dropDownList($datas['zero']) ?>

                         <?= $form->field($model, 'columnId')->label('分类')->dropDownList($datas['one']) ?>

                        <?= $form->field($model, 'content')->label('内容')->widget('common\widgets\ueditor\Ueditor') ?>  

                        <?= $form->field($model, 'tags')->label('标签')->widget('common\widgets\tags\TagWidget') ?>

                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>