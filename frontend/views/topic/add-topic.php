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
            <?= $this->render('column',['columns'=>$columns]) ?>
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