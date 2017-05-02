<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\HtmlPurifier;
use yii\widgets\LinkPager;

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
	                <?php if( !Yii::$app->user->isGuest):?>
	                	<?= html::a('+添加话题',['topic/addtopic'],['class'=> 'guanzhu'])?>
	                <?php endif;?>
                	
                	<h3>交流社区</h3>
                	<p>介绍</p>
                	
                </div>

                <div class="col_4">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">

                            <li role="presentation" class="active">
                            <?=Html::a('All',['topic/index', 'sort'=>'all'],['id'=>'profile-tab'])?>
                            </li>
                            <li role="presentation">
                                <?=Html::a('Hot',['topic/index', 'sort'=>'hot'],['id'=>'profile-tab'])?>
                            </li>
                             <li role="presentation">
                                <?=Html::a('New',['topic/index', 'sort'=>'new'],['id'=>'profile-tab'])?>
                             </li>
                            <li role="presentation"><a href="#profile1" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">MyHistory</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active">
                                <?php foreach ($models as $key => $value): ?>
                                <div class="jobs-item with-thumb">
                                    <div class="thumb_top">
                                        <div class="thumb">
                                           <?= Html::a('<img class="media-object img-cricle" style=" width:30px;height:30px;"  src="http://www.facefrontend.com'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id]) ?>
                                        </div>
                                        <div class="jobs_right">
                                            <h6 class="title"><?=HTML::a($value->title,['topic/detail', 'id'=>$value->id])?></h6>
                                            <ul class="login_details1">
                                                <li><?=Html::a($value->user->username, ['user/person','id'=>$value->user->id]) ?></li>
                                            </ul>
                                            <p class="description">
                                                <?php echo Yii::$app->formatter->asRelativeTime($value->createdTime) ; ?>
                                                <br/>
                                                 <span class="">  <?php echo $value->column->name;?></span>
                                            </p>
                                            <p>
                                             <?=HtmlPurifier::process( $value->abstrat) ?>
                                            </p>
                                            <?= html::a('readMore',['topic/detail','id' => $value->id])?>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <?php endforeach ;?>
                                <?= LinkPager::widget(['pagination' => $pages]); ?>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>