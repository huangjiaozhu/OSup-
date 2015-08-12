<?php
use yii\helpers\Html;
$this -> title = "新鲜事";
?>
<?php foreach($data as $user):?>
<div class="chapter">
    <div class="head">
        <span id="id<?=$user['id']?>" class=" sr-only"><?=Html::encode($user['id']) ?></span>
        <img class="userimg" src="<?php if($user['author_img']!="")echo $user['author_img'];else echo "./img/jiaozhu1.png"?>">
            <?=Html::encode($user['author']) ?>
    </div>
    <div class="describe">
            <?=Html::encode($user['describe']) ?>
    </div>
    <div>
        <?php if(Html::encode($user['bodyimg'])!=""):?>
        <img src="<?=Html::encode($user['bodyimg'])?>" class="bodyimg">
        <?php endif?>
    </div>
    <?php if($user['bestanswer']!=""):?>
    <div class="chat">
        <div class="bestanswer">
            <div class="nav" style="float: left">
                <span class="glyphicon glyphicon-star"></span>
                <span>神回复</span>
            </div>
            <div class="nav" style="float: right">
                <span class="glyphicon glyphicon-user"></span>
                <span><?=Html::encode($user['answername'])?></span>
            </div>
<!--            span是行内元素，不会另起一行-->
<!--            div是块级元素两个div会另起一行-->
        </div>
        <div class="chatmessage">
            <?=Html::encode($user['bestanswer']) ?>
        </div>
    </div>
    <?php endif;?>
    <hr/>
    <div class="foot" style="min-width: 290px">
        <div id="" class="nav count" style="float: left">
            <a class="fa-2x good" href="javascript:"><span class="fa fa-smile-o">&nbsp;</span><span class="line num"><?=Html::encode($user['countgood'])?>&nbsp;&nbsp;</span></a>
                <a class="fa-2x bad" href="javascript:"><span class="fa fa-meh-o">&nbsp;</span><span class="num"><?=Html::encode($user['countbad'])?>&nbsp;&nbsp;</span></a>
        </div>
        <div class="nav" style="float: right">
            <a class="fa-2x" href="?r=test/comment&id=<?=$user['id']?>"><span class="fa fa-comments-o">&nbsp;</span><span class="num"><?=Html::encode($user['totalcomment'])?>&nbsp;&nbsp;</span></a>
            <a class="fa-2x" href="javascript:void(0)"><span class="fa fa-share-square-o">&nbsp;</span><span>分享</span></a>
        </div>
    </div>
</div>
<?php endforeach;?>
<div id="morechapter" class="morechapter">
    <a href="javascript:"><span>点击加载更多...</span></a>
</div>