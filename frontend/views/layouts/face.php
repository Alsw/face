<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title>Face Community</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
   <header>
        <div class="navbar navbar-inverse-gray navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="index.html"><img src="images/logo.png" style="height: 40px" alt="logo"></a>
                    <div class="pull-right">
                        <nav class="navbar nav_bottom" role="navigation">
                            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                                <ul class="nav navbar-nav nav_1">
                                    <li><?= Html::a('首页', ['user/index']) ?></li>
                                    <li><?= Html::a('资讯', ['article/index']) ?></li>
                                    <li><?= Html::a('话题', ['topic/index']) ?></li>
                                    <li><?= Html::a('FindMe', ['face/index']) ?></li>
                                    <?php if(Yii::$app->user->isGuest) :?>
                                        <li>
                                           <?= Html::a(' 登录', ['user/login']) ?>
                                        </li>
                                        <li>
                                           <?= Html::a(' 注冊', ['user/register']) ?>
                                        </li>
                                    <?php else :?>
                                     <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php echo '<img class="Avatar" style="width:25px;height:25px;" src="'.Yii::$app->user->identity->avatar.'">'; ?>
                                            
                                            <?= Yii::$app->user->identity->username ;?>
                                            <span class="caret"></span>
                                            </a>
                                        <ul class="dropdown-menu" role="menu" >
                                            <li><?= Html::a('个人主页', ['user/person','id'=>Yii::$app->user->identity->id]) ?></li>
                                            <li id="logout-li">
                                             <a id="logout">
                                                <?= Html::beginForm(['/user/logout'], 'post') ?>
                                                    <?= Html::submitButton(
                                                        'Logout', ['class' => 'logout']
                                                    )?>
                                                <?= Html::endForm() ?>    
                                             </a>
                                            </li>
                                        </ul>
                                    </li>
                                   
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </header>
    <?= $content ?>
    <footer>
        <div class="footer">
            <div class="container">
                <div class="col-md-4 col_2">
                    <h4>关于我们</h4>
                    <p>致力于成为一个人脸识别交流社区</p>
                </div>
                <div class="col-md-4 col_2">
                    <h4>技术支持</h4>
                    <ul class="footer_links">
                        <li><a href="#">bootstrap中文社区</a></li>
                        <li><a href="#">thinkface论坛</a></li>
                        <li><a href="#">yii中文社区</a></li>
                        <li><a href="http://glyphicons.com/">Glyphicons</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col_2">
                    <h4>快速链接</h4>
                    <ul class="footer_links">
                        <li><a href="#">无</a></li>
                        <li><a href="#">无</a></li>
                        <li><a href="#">无</a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
                <div class="copy">
                    <!-- <p>Copyright &copy; 2015.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p> -->
                </div>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>