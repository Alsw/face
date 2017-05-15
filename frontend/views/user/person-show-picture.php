<?php  
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use common\widgets\file_upload\FileUpload; 
use frontend\models\UserAlbum;
$UserAlbum = new UserAlbum;
AppAsset::addJs($this, 'js/bootstrap.min.js');

?>
 <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="picture" aria-labelledby="home-tab">
        <div class="list-header">
            <div class="SubTabs">
                <?php if ($model->id == Yii::$app->user->identity->id): ?>
                    <a class="SubTabs-item is-active" >我的相册</a>
                    <a class="SubTabs-item ">添加图片</a>
                <?php elseif($model->sex == '男'): ?>
                    <a class="SubTabs-item  is-active" >他的相册</a>
                <?php elseif($model->sex == '女'): ?>
                    <a class="SubTabs-item is-active" >她的相册</a>
                <?php endif ?>
            </div>
        </div>
        <div class="row picture myAt">
            <?php foreach ($data as $key => $value): ?>
              <div class="col-lg-3 col-sm-3 col-xs-4" data-toggle="modal" data-target="#myModal">
                <a data-message="<?php echo $value->description; ?>">
                    <img src="<?php echo $value->imgPath; ?>" class="thumbnail img-responsive">
                </a>
            </div> 
            <?php endforeach ?>
            
             
        </div>
        <?php if ($model->id == Yii::$app->user->identity->id): ?>
            <div class="row atMe" style="display: none;">
                <div class="col-lg-10 col-sm-10 col-xs-10">
                   <?php $form = ActiveForm::begin(['action' => ['user/album'],'method'=>'post']); ?>
                        <div class="personEdit">
                            <?= $form->field($UserAlbum, 'imgPath')->widget('common\widgets\file_upload\FileUpload')->label('图片上传') ?>
                        </div>
                        <div class="personEdit">
                            <?= $form->field($UserAlbum, 'description')->textarea(['rows'=>3])->label('图片描述') ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('确认', ['class' =>'btn btn-primary']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php endif ?>
      
    </div>
</div>


<!-- Modal -->
<div class="dialogs"></div>
