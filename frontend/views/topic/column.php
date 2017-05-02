<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */

?>
 <div class="col-md-3 col_5">
                <ul class="menu">
                    <li class="item1">
                        <h3 class="m_2">按时间分类</h3>
                        <ul class="cute">
                            <li class="subitem1"><a href="#">一周内(8) </a></li>
                            <li class="subitem2"><a href="#">一月内(14)</a></li>
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
