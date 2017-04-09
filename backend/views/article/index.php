<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'categoryId',
            'tagIds:ntext',
            'source',
            // 'sourceUrl:url',
            // 'publishedTime',
            // 'body:ntext',
            // 'thumb',
            // 'originalThumb',
            // 'picture',
            // 'status',
            // 'hits',
            // 'promoted',
            // 'postNum',
            // 'upsNum',
            // 'userId',
            // 'createdTime',
            // 'updatedTime',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
