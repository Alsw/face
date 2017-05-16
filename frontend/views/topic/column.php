<?php

use yii\helpers\Html;
use common\models\Topic;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */
$data = Topic::find();
$week = $data->where(['>', 'createdTime', time()-604800])->count();
$month = $data->where(['>', 'createdTime', time()-2592000])->count();
?>
 <div class="col-md-3 col_5">
                <ul class="menu" style="margin-top: 70px;">
                    <li class="item1">
                        <h3 class="m_2">按时间分类</h3>
                        <ul class="cute">
                            <li class="subitem1">
                            	<?=Html::a('一周内('.$week.')',['topic/index', 'sort'=>'week'])?>
                            </li>
                            <li class="subitem2">
                            	<?=Html::a('一月内('.$month.')' ,['topic/index', 'sort'=>'month'])?>
                            </li>
                        </ul>
                    </li>

                    <?php foreach ($columns as $key => $value): ?>
                    	<li class="item1">
	                        <h3 class="m_2"><?php echo $value->name; ?></h3>
	                        <ul class="cute">
			                    <?php foreach ($value->children as $key => $item): ?>
									<li class="subitem1" title=<?php echo $item->profile;?>>
									<?=Html::a($item->name,['topic/index', 'sort'=>$item->id])?>
									</li>
			                    <?php endforeach; ?>
	                        </ul>
	                    </li>
                    <?php endforeach; ?>
                 
                </ul>
            </div>
