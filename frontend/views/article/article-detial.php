<?php 
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\assets\AppAsset;
use yii\widgets\LinkPager;
?>
<style type="text/css">
    .person{
        display: none;
        overflow: hidden;
    }
    .person  #createComment {
        float: right;
    }
    .like-active{
        background: url(../images/like.png) no-repeat 4px -24px;
        color: #395996;
    }
</style>
<div class="page-container">
    <div class="container mains ">
        <div class="row">
            <div class="span8 col-lg-8">
                <article>
                    <header>
                        <h3>
                            <?=HTML::tag('p',$model->title,['article/detial'])?>
                        </h3>
                        <div class="border">
                            <span class="date"><?php echo date("Y-m-d H:i", $model->createdTime) ?></span>
                            <span class="category"><?=HTML::a($model->user->username,['user/person','id'=>$model->user->id])?></span>
                            <span class="comments">
                            <a href="#" ><?php echo $model->postNum; ?></a>
                            </span>
                            <span class="like-count" data-id=<?php echo $model->id;
                                ?>><?php echo $model->upsNum; ?></span>
                        </div>
                    </header>
                    <p>
                     <?=HtmlPurifier::process($model->body) ?>
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

                                  <li class="media" data-id=<?php echo $value->id;?>>
                                    <div class="media-left">
                                        <?= Html::a('<img class="media-object img-cricle" width="45" height="45" src="'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id]) ?>
                                    </div>
                                    <div class="media-body" >
                                        <h4 class="media-heading">
                                            <?=Html::a($value->user->username, ['user/person','id'=>$value->user->id])?>
                                        </h4>
                                        <span><?php echo date("Y-m-d H:i", $value->createdTime) ?></span>
                                        <p> <?=HtmlPurifier::process($value->content) ?></p>
                                    </div>
                                    <div class="media-right" data-id=<?php echo $value->user->id;?> >
                                        <div class="huifu">
                                            <a class="personCommet">回复</a>
                                        </div>
                                    </div>
                                    <div class="publish person">
                                        <textarea id="comment-text" placeholder="参与讨论。支持markdown语法" class="input-block-level"></textarea>
                                        <div >
                                            <button id="createComment">发表评论</button>
                                        </div>
                                    </div>
                                     <?php if(!empty($value->children)): ?>  
                                        <?php foreach ($value->children as  $items): ?>
                                             <div class="media" style="margin-left: 40px;"  data-id=<?php echo $value->id;?>>
                                                <div class="media-left">
                                                     <?= Html::a('<img class="media-object img-cricle" width="45" height="45" src="'.$items->user->avatar.'">', ['user/person','id'=>$items->user->id]) ?>
                                                </div>
                                                  <div class="media-body" >
                                                    <h4 class="media-heading">
                                                        <?=Html::a($items->user->username, ['user/person','id'=>$items->user->id])?>
                                                    </h4>
                                                    <span><?php echo date("Y-m-d H:i", $items->createdTime) ?></span>

                                                    <p>
                                                        <?php if ($items->toUser !== null):?>
                                                            <?php echo '@'.$items->toUser->username.''; ?>
                                                        <?php endif; ?>  
                                                        <?php echo $items->content; ?>
                                                    </p>
                                                </div>
                                               <div class="media-right" data-id=<?php echo $items->user->id;?> >
                                                    <div class="huifu">
                                                        <a class="personCommet">回复</a>
                                                    </div>
                                                </div>
                                                <div class="publish person">
                                                    <textarea id="comment-text" placeholder="参与讨论。支持markdown语法" class="input-block-level" style="width: 80%"></textarea>
                                                    <div>
                                                        <button"id="createComment">发表评论</button>
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