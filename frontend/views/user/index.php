<?php 
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;
?>
<div>
    <div class="jumbotron">
            <h1>Face Community</h1>
            <p>...</p>
        </div>
    </div>
    <div>
        <div class="grid_2">
            <div class="container">
                <h2>Face Community</h2>
                <div class="heart-divider">
                </div>
                <div class="row_1">
                    <div class="col-md-8 suceess_story">
                        <ul>
                        <?php foreach ($models as $key => $value): ?>
                             <li>
                                <div class="suceess_story-date">
                                    <span class="entry-1"><?php echo Yii::$app->formatter->asRelativeTime($value->createdTime) ; ?></span>
                                </div>
                                <div class="suceess_story-content-container">
                                    <figure class="suceess_story-content-featured-image">
                                        <img width="75" height="75" src="<?php echo $value->user->avatar; ?>" class="img-responsive" alt="" />
                                    </figure>
                                    <div class="suceess_story-content-info">
                                        <h4>
                                            <?=HTML::a($value->title,['article/detial', 'id'=>$value->id])?>
                                        </h4>
                                        <p>
                                        <?=HtmlPurifier::process($value->abstrat) ?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="col-md-4 row_1-right">
                        <h3>推荐用户</h3>
                        <?php foreach ($userModels as $key => $value): ?>
                            <div class="box_1">
                                <figure class="thumbnail1">
                                    <?= Html::a('<img class="media-object img-cricle"  style="width:75px; height:75px; display:inline-block;" src="http://www.facefrontend.com'.$value->avatar.'">', ['user/person','id'=>$value->id])  ?>
                                </figure>
                                <div class="extra-wrap">
                                    <div class="post-meta">
                                        <p><?php echo($value->username) ?></p>
                                    </div>
                                    <div class="clearfix"> </div>
                                    <div class="post-content"> 
                                        <?=HtmlPurifier::process($value->introduce) ?>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php endforeach ?>

                            <div class="religion">
                                <div class="religion_1-title">话题 :</div>
                                <a href="index.php?r=topic/index"  class="religion_1" title="Hindu Matrimonial" style="padding-left:0px !important;">人脸识别</a>
                                <span>|</span><a href="index.php?r=topic/index" target="_blank" class="religion_1" title="Muslim Matrimonial">人工智能</a>
                                <span>|</span><a href="index.php?r=topic/index" target="_blank" class="religion_1" title="Christian Matrimonial">资源</a>
                            </div>
                       
                        
                        <div class="religion">
                            <div class="religion_1-title">资讯 :</div>
                            <a href="index.php?r=article/index" target="_blank" class="religion_1" title="Hindu Matrimonial" style="padding-left:0px !important;">新闻</a>
                            <span>|</span><a href="index.php?r=article/index" target="_blank" class="religion_1" title="Muslim Matrimonial">图文</a>
                            <span>|</span><a href="index.php?r=article/index" target="_blank" class="religion_1" title="Christian Matrimonial">视频</a>
                            <span>|</span><a href="index.php?r=article/index" target="_blank" class="religion_1" title="Sikh Matrimonial">综艺</a>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    AppAsset::addJs($this, 'js/article.js');
?>