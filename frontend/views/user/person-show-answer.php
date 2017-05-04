<?php  
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\assets\AppAsset;

AppAsset::addCss($this, 'css/topic.css');
?>
 <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="answer" aria-labelledby="home-tab">
        <div class="list-header">
            <h4>
                <?php if ($model->id == Yii::$app->user->identity->id): ?>
                   <span>我的回答</span>
                <?php elseif($model->sex == '男'): ?>
                   <span>他的回答</span>
                <?php elseif($model->sex == '女'): ?>
                   <span>她的回答</span>
                <?php endif ?>
            </h4>
        </div>
        <?php foreach ($data as $key => $value): ?>
            <div class="tab_box">
                <div class="box_header">
                    <span><?php echo Yii::$app->formatter->asRelativeTime($value->createdTime) ; ?></span>
                </div>
                <div>
                    <a href="/index.php?r=topic%2Fdetail&id=<?php echo $value->topic->id; ?>">
                    <h1 style=" font-size: 18px;font-weight: 700;color: #1e1e1e;line-height: 1.6;">
                         <?=HtmlPurifier::process($value->topic->title) ?>
                    </h1>
                    </a>
                </div>
                <div class="box_body">
                  <div class="left">
                   <?= Html::a('<img class="media-object img-cricle"  style="width:40px; height:40px; display:inline-block;" src="http://www.facefrontend.com'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id])  ?>
                     
                   </div>
                  <div class="left"> 
                    <div class="name">
                        <span>
                          <?php echo $value->user->username; ?>
                        </span>
                    </div>
                    <div class="title">
                        <span>
                            <?php echo $value->user->introduce; ?>
                        </span>
                    </div>
                  </div>
                </div>
                <div class="value-abstrat">
                   <?=HtmlPurifier::process($value->abstrat) ?>
                </div>
                <div style="display: none" class="value-content">
                   <?=HtmlPurifier::process($value->content) ?>
                </div>
                <a data-type='0' class="detail">查看详细</a>
                <div class="goodCount" data-id=<?php echo $value->id; ?>>
                   <?php if ($value->isLikes()['islike']): ?>
                       <p class="active">
                          <span class="up"></span>
                          <span class="count"><?php echo $value->isLikes()['likeCount']; ?></span>
                      </p>
                    <?php else: ?>
                       <p >
                          <span class="up"></span>
                          <span class="count"><?php echo $value->isLikes()['likeCount']; ?></span>
                      </p>
                    <?php endif;?>
                      <p>
                          <span class="down"></span>
                      </p>
                </div>
            </div>
        <?php  endforeach; ?>
    </div>
</div>