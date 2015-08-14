<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/8/1
 * Time: 19:54
 */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "sdkj";
?>
<div id="rank">
<?php foreach($data as $one):?>
    <div class="rank">
    <h4><a href="<?=Url::toRoute(['comment','id'=>$one->id])?>">
            <?php if(Html::encode(substr($one->describe,0,9)!="")):?>
            <?=Html::encode(substr($one->describe,0,9))?>
            <?php else:?>
                &nbsp;&nbsp;&nbsp;
            <?php endif;?>
            <?php echo strlen($one->describe)>9?"...":""?></a></h4>
    <P><span class=""><?=Html::encode($one->totalcomment)?></span></P>
    </div>
<?php endforeach;?>
</div>
