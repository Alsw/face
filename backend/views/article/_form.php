<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\file_upload\FileUpload; 
use common\widgets\ueditor\Ueditor; 
use common\widgets\tags\TagWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->label('标题')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoryId')->label('栏目')->dropDownList($datas) ?>

    
    <?= $form->field($model, 'tagIds')->label('标签')->widget('common\widgets\tags\TagWidget') ?>


    <?= $form->field($model, 'source')->label('资源')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sourceUrl')->label('资源链接')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abstrat')->label('摘要:(请自行编辑，否则取文章前200字)')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->label('内容')->widget('common\widgets\ueditor\Ueditor') ?>  

    <?= $form->field($model, 'thumb')->widget('common\widgets\file_upload\FileUpload') ?>
    
    <?= $form->field($model, 'originalThumb')->widget('common\widgets\file_upload\FileUpload') ?>

    <?= $form->field($model, 'status')->label('是否推送')->dropDownList([ 'published' => '发送', 'unpublished' => '延缓', 'trash' => '废弃' ]) ?>

    <?= $form->field($model, 'promoted')->label('是否推荐')->dropDownList([ '1' => '推荐', '0' => '不推荐']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
