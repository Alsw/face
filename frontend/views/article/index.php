<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\LinkPager;

?>
<div class="page-container">
        <div class="container mains">
            <div class="row">
                <div class="span8 col-lg-8">
                   
                    <?php foreach($datas as $model): ?> 
                        <article style="margin-bottom: 20px;">
                            <header>
                                <h3>
                                    <?=HTML::a($model->title,['article/detial', 'id'=>$model->id])?>
                                </h3>
                                <div class="border">
                                
                                    <span class="date"><?php echo Yii::$app->formatter->asRelativeTime($model->createdTime) ; ?></span>
                                    <span class="category"><?=HTML::a($model->user->username,['user/person','id'=>$model->user->id])?></span>
                                    <span class="comments">
                                    <a href="#" ><?php echo $model->postNum; ?></a>
                                    </span>
                                    <span class="like-count" data-id=<?php echo $model->id;?>><?php echo $model->upsNum; ?></span>
                                </div>
                            </header>
                            <a href="#" title="Using Images">
                                <?php echo '<img src="http://112.74.49.39:8080'.$model->thumb.'" width="600" class=" wp-post-image" alt="Living room">'; ?>
                            </a>
                            <p>
                                <?php echo $model->abstrat; ?>
                                <span></span>
                                 <?= Html::a(' Read more', ['article/detial','class'=>'readmore-link','id'=>$model->id]) ?>
                            </p>
                           
                        </article>
                    <?php endforeach; ?>
                    <?= LinkPager::widget(['pagination' => $pages]); ?>
                </div>
                <aside class="span4 page-sidebar col-lg-4">
                    <section class="widget">
                        <div class="support-widget">
                            <h3 class="title">新闻资讯</h3>
                            <p class="intro">推广生活在有意思的人或者事</p>
                        </div>
                    </section>
                    <section class="widget">
                        <h3 class="title">最热浏览</h3>
                        <ul class="articles">
                        <?php foreach ($promotedDatas as $key => $value): ?>
                             <li class="article-entry standard">
                                <h4>
                                    <?=HTML::a($value->title,['article/detial', 'id'=>$value->id])?>
                                </h4>
                                <span class="article-meta">
                                    <?php echo Yii::$app->formatter->asRelativeTime($value->createdTime) ; ?>
                                    By
                                    <?php echo($value->user->username) ?>
                                        
                                    
                                </span>
                                <span class="like-count" data-id=<?php echo $value->id;?>><?php echo($value->upsNum) ?></span>
                            </li>
                        <?php endforeach ?>
                           
                          
                        </ul>
                    </section>
                    <section class="widget">
                        <h3 class="title">分类</h3>
                        <ul>
                            <?php foreach ($categoryName as $key => $value): ?>
                            <li><?=HTML::a($value->name,['article/category','id' => $key]);?></li>
                            <?php endforeach;?>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>
<?php 
    AppAsset::addJs($this, 'js/article.js');
?>