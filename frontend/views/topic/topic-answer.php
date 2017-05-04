<?php  
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\assets\AppAsset;

AppAsset::addCss($this, 'css/person.css');
?>
<div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="dynamic">
          <div>
              <div class="list-header">
                <h4>
                    <span><?php echo count($answerModels); ?></span><span>个回答</span>
                </h4>
            </div>
            <?php foreach ($answerModels as $key => $value): ?>
                <div class="tab_box">
                    <div class="box_body">
                      <div class="left">
                       <?= Html::a('<img class="media-object img-cricle"  style="width:40px; height:40px; display:inline-block;" src="http://www.facefrontend.com'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id]) ?>
                         
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
                    <div class="box_header">
                        <span>
                          <?php echo $value->isLikes()['likeCount'];  ?>
                        </span>
                        <span>人赞同该回答</span>
                        <span></span>
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
                <div class="Comments Comments--withEditor Comments-withPagination">
                    <div class="CommentTopbar">
                       <div class="CommentTopbar-meta">
                           <h2 class="CommentTopbar-title">
                               <span><?php echo count($value->commentsAsArray()); ?></span>条评论
                           </h2>
                       </div>
                       <div></div>
                    </div>
                   <?php foreach ($value->commentsAsArray() as $key => $value): ?>
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
                                    <?php if ($value->user->id === $value->userId):?>
                                       <span>
                                        (题主)
                                       </span>
                                    <?php endif ;?>
                                    <?php if ($value->toUserId != 0 ): ?>
                                      <span >
                                        <span class="topic-huifu">
                                          回复
                                        </span>                                 
                                         <span>
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
                        <div class="CommentItem-editor CommentEditor--inCommentItem answer-comment" >
                                 <div style="display: none" id="objectData" data-id=<?php echo $value->id ;?>>
                                    <input name="_csrf" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>"> 
                                </div>
                                <div class="Editable " id="input-footer">
                                  <input type="text" class="Input" id="comment-text"  data-id=<?php echo $value->id ;?>>
                                </div>
                                <div class="CommentEditor-actions" id="comment-footer">
                                  <button class="btn btm-primary btn-blue" type="button">评论</button>
                                </div>
                        </div>
                   </div>
                </div>
            <?php endforeach ?>
            </div>
        </div>
</div>