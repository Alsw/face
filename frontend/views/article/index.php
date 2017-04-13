<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::addCss($this, 'css/bootstrap-3.1.1.min.css');
?>
<div class="page-container">
        <div class="container mains">
            <div class="row">
                <div class="span8 col-lg-8">
                   
                    <?php foreach($datas as $model): ?> 
                        <article>
                            <header>
                                <h3>
                                    <?=HTML::a($model->title,['article/detial', 'id'=>$model->id])?>
                                </h3>
                                <div class="border">
                                    <span class="date"><?php echo $model->createdTime;  ?></span>
                                    <span class="category"><?=HTML::a($model->userId,['user/person'])?></span>
                                    <span class="comments"><a href="#" >3</a></span>
                                    <span class="like-count">66</span>
                                </div>
                            </header>
                            <a href="#" title="Using Images">
                                <?php echo '<img src="http://www.facebackend.com'.$model->thumb.'" width="600" class=" wp-post-image" alt="Living room">'; ?>
                            </a>
                            <p>
                                <?php echo $model->abstrat; ?>
                                 <?= Html::a(' Read more', ['article/detial','class'=>'readmore-link','id'=>$model->id]) ?>
                            </p>
                           
                        </article>
                    <?php endforeach; ?>
                    <div id="pagination">
                        <a href="#" class="btn active">1</a>
                        <a href="#" class="btn">2</a>
                        <a href="#" class="btn">3</a>
                        <a href="#" class="btn">Next »</a>
                        <a href="#" class="btn">Last »</a>
                    </div>
                </div>
                <aside class="span4 page-sidebar col-lg-4">
                    <section class="widget">
                        <div class="support-widget">
                            <h3 class="title">那个Ta</h3>
                            <p class="intro">生活中的不经意回眸，或许能看到另一个你，是否想看到更多关于那个Ta的奇闻轶事呢？</p>
                        </div>
                    </section>
                    <section class="widget">
                        <h3 class="title">最热浏览</h3>
                        <ul class="articles">
                            <li class="article-entry standard">
                                <h4><a href="single.html">撞脸：你也许真有一个活生生的分身？</a></h4>
                                <span class="article-meta">2017-01-16 by<a href="#" title="View all posts in Server &amp; Database">Gorvett 利维坦</a></span>
                                <span class="like-count">66</span>
                            </li>
                            <li class="article-entry standard">
                                <h4><a href="single.html">撞脸：你也许真有一个活生生的分身？</a></h4>
                                <span class="article-meta">2017-01-16 by<a href="#" title="View all posts in Server &amp; Database">Gorvett 利维坦</a></span>
                                <span class="like-count">66</span>
                            </li>
                        </ul>
                    </section>
                    <section class="widget">
                        <h3 class="title">分类</h3>
                        <ul>
                            <?php foreach ($categoryName as $key => $value): ?>
                            <li><?=HTML::a($value,['article/category','id' => $key]);?></li>
                            <?php endforeach;?>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>