<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\assets\AppAsset;
use yii\widgets\LinkPager;

AppAsset::addCss($this, 'css/topic.css');
AppAsset::addJs($this, 'js/bootstrap.min.js');
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
                <div class="col_4">
                    <div id="myTabContent" class="tab-content">
                         <div role="tabpanel" class="tab-pane fade in active">
                            <div class="jobs-item with-thumb">
                                <div class="thumb_top">
                                    <div class="thumb">
                                       <?= Html::a('<img class="media-object img-cricle"  style="width:50px; height:50px;" src="http://www.facefrontend.com'.$model->user->avatar.'">', ['user/person','id'=>$model->user->id]) ?>
                                     
                                    </div>
                                    <div class="jobs_right">
                                        <h4 class="title">
                                            <?php echo $model->title; ?>
                                        </h4>
                                        <h5><?=Html::a($model->user->username, ['user/person','id'=>$model->user->id]) ?></h5>
                                        <h5>
                                         <?php echo Yii::$app->formatter->asRelativeTime($model->createdTime) ; ?>
                                        </h5>
                                        <h5>
                                            <?php echo $model->column->name;?>
                                        </h5>
                                       
                                        <p>
                                             <?=HtmlPurifier::process($model->content) ?>
                                        </p>
                                       
                                    </div>
                                
                                    <div class="goodCount">
                                     <?php if ($model->isLikes()['islike']): ?>
                                         <p class="active">
                                            <span class="up"></span>
                                            <span class="count"><?php echo $model->isLikes()['likeCount']; ?></span>
                                        </p>

                                      <?php else: ?>
                                         <p >
                                            <span class="up"></span>
                                            <span class="count"><?php echo $model->isLikes()['likeCount']; ?></span>
                                            
                                        </p>

                                      <?php endif;?>
                                        <p>
                                            <span class="down"></span>
                                        </p>
                                    </div>
                                    <div class="Comments Comments--withEditor Comments-withPagination">
                                        <div class="CommentTopbar">
                                           <div class="CommentTopbar-meta">
                                               <h2 class="CommentTopbar-title">
                                                   <span><?php echo count($comment); ?></span>条评论
                                               </h2>
                                           </div>
                                           <div></div>
                                       </div>
                                       <?php foreach ($comment as $key => $value): ?>
                                          <div class="commnet-simple">
                                             <div class="CommentItem">
                                                 <div id="comment-id" data-userId=<?php echo $value->user->id; ?> data-id=<?php echo $value->id;?>>
                                                     <div class="CommentItem-meta">
                                                        <span> 
                                                        <?= Html::a('<img class="media-object img-cricle"  style="width:24px; height:24px; display:inline-block;" src="http://www.facefrontend.com'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id]) ?>
                                                            
                                                        </span>
                                                        <span>
                                                          <?php echo $value->user->username; ?>
                                                        </span>
                                                        <?php if ($value->user->id === $model->userId):?>
                                                           <span>
                                                            (题主)
                                                           </span>
                                                        <?php endif ;?>
                                                        <?php if ($value->toUserId != 0 ): ?>
                                                          <span >
                                                            <span class="topic-huifu">
                                                              回复
                                                            </span>                                  <span>
                                                              <?php echo $value->toUser->username; ?>
                                                            </span>  
                                                        </span>
                                                        <?php endif?>
                                                        
                                                        <span class="topic-time">
                                                           <?php echo Yii::$app->formatter->asRelativeTime($value->createdTime) ; ?>
                                                        </span>   
                                                     </div>
                                                    <div class="RichText CommentItem-content">
                                                      <?=HtmlPurifier::process($value->content) ?>
                                                    </div>
                                                    <div class="CommentItem-footer topic-comment">
                                                    <a class="comment-like borders">
                                                       <?php if ($value->isLikes()['islike']): ?>
                                                         <span class="like-active">
                                                         <?php echo $value->isLikes()['likeCount'] ; ?></span>
                                                       <?php else: ?>
                                                         <span class="like-count"> 
                                                         <?php echo $value->isLikes()['likeCount'] ; ?>
                                                         </span>
                                                       <?php endif;?>
                                                      </a>
                                                      <?php if (!empty($value->children)):?>
                                                        <a data-toggle="modal" data-target="#myModal" class="dialog">
                                                          <span class="glyphicon glyphicon-comment"></span>
                                                          <span>查看对话</span>
                                                        </a>
                                                      <?php endif ?>
                                                      
                                                      <a  class="topic-huifu" style="float: right;">
                                                        <span class="glyphicon glyphicon-edit"></span>
                                                        <span>回复</span>
                                                      </a>
                                                    </div>
                                                    <div class="CommentItem-editor CommentEditor--inCommentItem" style="display: none">

                                                      <div class="Editable">
                                                        <input type="text" placeholder="" class="Input">
                                                      </div>
                                                      <div class="CommentEditor-actions">
                                                        <button class="btn btm-primary btn-blue pinglun" type="button">评论</button>
                                                        <button  class="quxiao" >
                                                          取消
                                                        </button>
                                                      </div>
                                                    </div>

                                                 </div>
                                             </div>
                                          </div>
                                       <?php endforeach; ?>
                                       <div class="Comments-footer Comments-footer-withPagination CommentEditor--normal">
                                            <div class="CommentItem-editor CommentEditor--inCommentItem " >
                                                     <div style="display: none" id="objectData" data-id=<?php echo $model->id ;?>>
                                                        <input name="_csrf" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>"> 
                                                    </div>
                                                    <div class="Editable " id="input-footer">
                                                      <input type="text" class="Input" id="comment-text"  data-id=<?php echo $model->id ;?>>
                                                    </div>
                                                    <div class="CommentEditor-actions" id="comment-footer">
                                                      <button class="btn btm-primary btn-blue" type="button">评论</button>
                                                    </div>
                                            </div>
                                       </div>
                                   </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
    </div>
</div>

  <?php 
  AppAsset::addJs($this, 'js/topic.js');
  ?>