<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
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
            <div class="col-md-3 col_5">
                <ul class="menu">
                    <li class="item1">
                        <h3 class="m_2">按时间分类</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">一周内(8) </a></li>
                            <li class="subitem2"><a href="#">一月内(14)</a></li>
                        </ul>
                    </li>
                    <li class="item1">
                        <h3 class="m_2">人脸</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">人脸识别(2)</a></li>
                            <li class="subitem1"><a href="#">表情识别(5)</a></li>
                            <li class="subitem1"><a href="#">人脸检测(5)</a></li>
                            <li class="subitem1"><a href="#">人脸搜索(5)</a></li>
                        </ul>
                    </li>
                    <li class="item1">
                        <h3 class="m_2">智能</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">数据挖掘</a></li>
                            <li class="subitem1"><a href="#">神经网络</a></li>
                            <li class="subitem1"><a href="#">机器学习</a></li>
                        </ul>
                    </li>
                    <li class="item1">
                        <h3 class="m_2">资源共享</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">数据分享</a></li>
                            <li class="subitem1"><a href="#">源码共享</a></li>
                            <li class="subitem1"><a href="#">书籍推荐</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
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
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">All</a></li>
                            <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Hot</a></li>
                             <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">New</a></li>
                            <li role="presentation"><a href="#profile1" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">MyHistory</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active">
                                <?php foreach ($models as $key => $value): ?>
                                <div class="jobs-item with-thumb">
                                    <div class="thumb_top">
                                        <div class="thumb">
                                           <?= Html::a('<img class="media-object img-cricle"  src="http://www.facefrontend.com'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id]) ?>
                                        </div>
                                        <div class="jobs_right">
                                            <h6 class="title"><?=HTML::a($value->title,['topic/detail', 'id'=>$value->id])?></h6>
                                            <ul class="login_details1">
                                                <li><?=Html::a($value->user->username, ['user/person','id'=>$value->user->id]) ?></li>
                                            </ul>
                                            <p class="description">
                                                <?php echo date("Y-m-d H:i", $value->createdTime) ?><br/>
                                                 <span class="">  <?php echo $value->column->name;?></span>
                                            </p>
                                            <p>
                                                 <?php echo $value->abstrat;?>
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