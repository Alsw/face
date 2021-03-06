<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此文章?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Publish', ['publish', 'id' => $model->id], ['class' => 'btn btn-info']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'categoryId',
            'tagIds:ntext',
            'source',
            'sourceUrl:url',
            'publishedTime',
            'body:ntext',
            'thumb',
            'originalThumb',
            'status',
            'hits',
            'promoted',
            'postNum',
            'upsNum',
            'userId',
            'createdTime',
            'updatedTime',
        ],
    ]) ?>

</div>
