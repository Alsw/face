<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;



?>
<div class="grid_3">
<div class="container">
    <div class="breadcrumb1">
        <ul>
            <a href="index.html"><i class="fa fa-home home_1"></i></a>
            <span class="divider">&nbsp;|&nbsp;</span>
            <li class="current-page">Register</li>
        </ul>
    </div>
    <div class="services">
        <div class="col-sm-5 login_left">
         <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'maxlength' => '60'])->label('UserName');?>
                
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => '60'])->label('PassWord');?>
                
                <?= $form->field($model, 'email')->label('Email') ?>
                
                <?= $form->field($model, 'phonenumber')->label('PhoneNumber') ?>
                
                <?= $form->field($model, 'birthday')->widget(
                    DatePicker::className(), [
                        'inline' => true, 
                        'options' =>[
                            'showAnim'=>'fold',  
                            'showOn'=>'both',  
                        ],
                        'template' => '{input}',
                        'language'=>'zh-CN',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                ]);?>
                <?= $form->field($model, 'sex')->textInput()->label('Sex')->radioList(['男'=>'男','女'=>'女']) ?>

                <?= $form->field($model, 'introduce')->textarea(['rows'=>4])->label('Introduce') ?>
                
                <div class="form-group">
                    <?= Html::submitButton('SignUp', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
</div>
<?php 
    AppAsset::addJs($this,'js/register.js');
?>