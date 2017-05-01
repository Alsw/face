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
                                          <p>
                                              <span class="up"></span>
                                              <?php echo $model->goodCount; ?>
                                          </p>
                                          <p>
                                              <span class="down"></span>
                                          </p>
                                    </div>
                                    <div class="Comments Comments--withEditor Comments-withPagination">
                                        <div class="CommentTopbar">
                                           <div class="CommentTopbar-meta">
                                               <h2 class="CommentTopbar-title">
                                                   100条评论
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
                                                        <?= Html::a('<img class="media-object img-cricle"  style="width:25px; height:25px; display:inline-block;" src="http://www.facefrontend.com'.$value->user->avatar.'">', ['user/person','id'=>$value->user->id]) ?>
                                                            
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
                                                            <span>
                                                              回复
                                                            </span>                                  <span>
                                                              <?php echo $value->toUser->username; ?>
                                                            </span>  
                                                        </span>
                                                        <?php endif?>
                                                        
                                                        <span>
                                                           <?php echo Yii::$app->formatter->asRelativeTime($value->createdTime) ; ?>
                                                        </span>   
                                                     </div>
                                                    <div class="RichText CommentItem-content">
                                                      <?=HtmlPurifier::process($value->content) ?>
                                                    </div>
                                                    <div class="CommentItem-footer topic-comment" >
                                                      <a href="#">
                                                        <span class="glyphicon glyphicon-thumbs-up"></span>
                                                        <span>20</span>
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