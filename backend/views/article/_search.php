<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'categoryId') ?>

    <?= $form->field($model, 'tagIds') ?>

    <?= $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'sourceUrl') ?>

    <?php // echo $form->field($model, 'publishedTime') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'thumb') ?>

    <?php // echo $form->field($model, 'originalThumb') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'hits') ?>

    <?php // echo $form->field($model, 'promoted') ?>

    <?php // echo $form->field($model, 'postNum') ?>

    <?php // echo $form->field($model, 'upsNum') ?>

    <?php // echo $form->field($model, 'userId') ?>

    <?php // echo $form->field($model, 'createdTime') ?>

    <?php // echo $form->field($model, 'updatedTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
