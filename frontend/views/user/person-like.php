<?php
use yii\helpers\Html;
?>
<div class="col-md-4 profile_right">
    <div class="view_profile">
        <h3>相似的人</h3>
        <?php foreach ($likeUsers as $key => $value): ?>
            <ul class="profile_item">
                <a href="#">
                    <li class="profile_item-img">
                     <?= Html::a('<img class="img-responsive" src="'.$value->getImg(array_keys($value->faceDatas)[0])->imgPath.'">', ['user/person','id'=>$value->id]) ?>
                    </li>
                    <li class="profile_item-desc">
                        <h4>
                        <?php  echo $value->username; ?>
                        </h4>
                        <p>相似度</p>
                        <h5><?php echo( $value->faceDatas[array_keys($value->faceDatas)[0]])  ?>%</h5>
                    </li>
                    <div class="clearfix"> </div>
                </a>
            </ul>
        <?php endforeach ?>
    </div>
</div>