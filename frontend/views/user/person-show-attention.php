<?php  
use yii\helpers\Html;

?>
 <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="attention" aria-labelledby="home-tab">
        <div class="list-header">
            <div class="SubTabs">
                <?php if ($model->id == Yii::$app->user->identity->id): ?>
                    <a class="SubTabs-item is-active" >我关注的人</a>
                    <a class="SubTabs-item ">关注我的人</a>
                <?php elseif($model->sex == '男'): ?>
                    <a class="SubTabs-item  is-active" >他关注的人</a>
                    <a class="SubTabs-item">关注他的人</a>
                <?php elseif($model->sex == '女'): ?>
                    <a class="SubTabs-item is-active" >她关注的人</a>
                    <a class="SubTabs-item ">关注她的人</a>
                <?php endif ?>
                
            </div>
        </div>
        <div class="myAt">
            <?php foreach ($model->myAttention() as $key => $value): ?>
                <div class="tab_box">
                    <div class="box_body">
                         <div class="left">
                            <?= Html::a('<img class="media-object img-cricle"  style="width:40px; height:40px; display:inline-block;" src="http://www.facefrontend.com'.$value->person->avatar.'">', ['user/person','id'=>$value->person->id])  ?>
                         </div>
                        <div class="left"> 
                            <div class="name">
                                <span>
                                   <?php echo $value->person->username; ?>
                                </span>
                            </div>
                            <div class="title">
                                <span>
                                   <?php echo $value->person->introduce; ?>
                                   
                                </span>
                            </div>
                      
                        </div>
                        <div class="right">
                            <a class="Button Button--grey">已关注</a>
                        </div>
                    </div>
                </div> 
            <?php endforeach ?>
        </div>
        <div class="atMe" style="display: none">
            <?php foreach ($model->attentionMe() as $key => $value): ?>
                <div class="tab_box">
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
                        <div class="right">
                            <a class="Button Button--grey">已关注</a>
                        </div>
                    </div>
                </div> 
            <?php endforeach ?>
        </div>
       

    </div>
</div>