<?php 
use yii\helpers\Html;
use frontend\assets\AppAsset
?>
<style type="text/css">
    .person{
        display: none;
    }
    .person  #createComment {
        float: right;
    }
</style>
<div class="page-container">
    <div class="container mains">
        <div class="row">
            <div class="span8 col-lg-8">
                <article>
                    <header>
                        <h3>
                            <?=HTML::tag('p',$model->title,['article/detial'])?>
                        </h3>
                        <div class="border">
                            <span class="date"><?php echo $model->createdTime;  ?></span>
                            <span class="category"><?=HTML::a($model->userId,['user/person'])?></span>
                            <span class="comments"><a href="#" >3</a></span>
                            <span class="like-count">66</span>
                        </div>
                    </header>
                    <p>
                        <?php echo $model->body; ?>
                    </p>
                </article>
                <div class="comment">
                    <div class="hd">评论</div>
                    <div style="display: none" id="objectData" data-id=<?php echo $model->id ;?>>
                        <input name="_csrf" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>"> 
                    </div>
                    <div class="bd">
                        <div class="publish">
                            <textarea id="comment-text" placeholder="参与讨论。支持markdown语法" class="input-block-level"></textarea>
                            <div >
                                <button id="createComment">发表评论</button>
                            </div>
                        </div>
                        <ul class="media-list">
                            <?php foreach ($comment as  $value): ?>

                                  <li class="media" data-id=<?php echo $value['comment']->id;?>>
                                    <div class="media-left">
                                        <?= Html::a('<img class="media-object img-cricle" width="45" height="45" src="http://www.facefrontend.com'.$value['user']->avatar.'">', ['user/person','id'=>$value['user']->id]) ?>
                                    </div>
                                    <div class="media-body" >
                                        <h4 class="media-heading">
                                            <?=Html::a($value['user']->username, ['user/person','id'=>$value['user']->id])?>
                                        </h4>
                                        <span><?php echo date("Y-m-d H:i", $value['comment']->createdTime) ?></span>
                                        <p><?php echo $value['comment']->content; ?></p>
                                    </div>
                                    <div class="media-right" data-id=<?php echo $value['user']->id;?> >
                                        <div class="huifu">
                                            <a class="personCommet">回复</a>
                                        </div>
                                    </div>
                                    <div style="display: none;" id="commentData" >
                                    </div>
                                    <div class="publish person">
                                        <textarea id="comment-text" placeholder="参与讨论。支持markdown语法" class="input-block-level"></textarea>
                                        <div >
                                            <button id="createComment">发表评论</button>
                                        </div>
                                    </div>
                                     <?php if(!empty($value['comment']->children)): ?>  
                                        <?php foreach ($value['comment']->children as  $items): ?>
                                             <div class="media" style="margin-left: 40px;">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object img-cricle" src="images/1.jpg" width="45" height="45" alt="...">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">Media heading</h4>
                                                    <span>2015年2月1日</span>
                                                    <p>评论内容12345679评论内容12345679评论内容12345679评论内容12345679评论内容12345679评论内容12345679评论内容12345679评论内容12345679评论内容123456798</p>
                                                </div>
                                                <div class="media-right ">
                                                    <div class="huifu">
                                                        <a href="#">回复</a>
                                                    </div>
                                                </div>
                                               </div>
                                        <?php endforeach;?>
                                    <?php endif; ?>  
                                    <div class="dev"></div>

                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
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
<?php 
    AppAsset::addJs($this, 'js/comment.js');
?>