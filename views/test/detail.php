<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/22
 * Time: 19:37
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
error_reporting( E_ALL&~E_NOTICE );
$this -> title = "详细信息";
?>

<div class="chapter">
    <div class="head">
        <span id="id<?=$model->id?>" class=" sr-only"><?=Html::encode($model->id) ?></span>
        <?php if($model->author_img==""):?>
        <img class="userimg" src="./img/jiaozhu1.png">
        <?php else:?>
        <img class="userimg" src="<?=Html::encode($model->author_img)?>">
        <?php endif;?>
        <?=Html::encode($model->author) ?>
    </div>
    <div class="describe">
        <?=Html::encode($model->describe) ?>
    </div>
    <div>
        <?php if(Html::encode($model->bodyimg)!=""):?>
            <img src="<?=Html::encode($model->bodyimg)?>" class="bodyimg">
        <?php endif?>
    </div>

    <hr/>
    <div class="comments">
        <?php foreach($comments as $key=>$comment){?>
        <div class="comment">
            <div class="head" style="position: relative">
                <div class="count" style="position: relative">
                    <span id="id<?=$comment->replyer?>" class=" sr-only"><?=Html::encode($model->id) ?></span>
                    <?php if($comment->replyer_img==""){?>
                    <img style="vertical-align: middle" class="userimg" src="./img/jiaozhu1.png">
                    <?php }else{?>
                    <img style="vertical-align: middle" class="userimg" src="<?=$comment->replyer_img?>">
                    <?php }?>
                    <span><strong><?=Html::encode($comment->replyer) ?></strong></span>
                    <span style="position: absolute;right: 5px;top: 40%">
                        <a href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-up">&nbsp;</span></a><span>12&nbsp;&nbsp;</span>
                    </span>
                </div>
            </div>

            <div class="comment" style="clear: both">
                <span><?=Html::encode($comment->comment)?></span>
                <?php if($recomment[$key]!=null){?>
                <div class="recomment">
                    <?php foreach($recomment[$key] as $onerecomment){ if($onerecomment!=""){?>
                    <p class="hr">
                        <?=Html::encode($onerecomment->replyer)?>
                        <?php if($onerecomment->replyer==$model->author){echo"<span class='louzhu'>楼主</span>";}?>
                        <?=Html::encode("@ ".$onerecomment->recomment_name)?>
                        <?php if($onerecomment->recomment_name==$model->author){echo"<span class='louzhu'>楼主</span>";}?>
                        <?=Html::encode(": ".$onerecomment->reply_content)?>
                        <a class="re-recomment" href="javascript:void(0)">回复</a>
                    </p>
                        <div class="recomment-hide">
                            <form method="post" action="?r=test/recomment">
                                <input type="text" hidden="hidden" name="chapterid" value="<?=$model->id?>">
                                <input type="text" hidden="hidden" name="commentid" value="<?=$comment->id?>">
                                <input type="text" hidden="hidden" name="recommentid" value="<?=$onerecomment->id?>">
                                <input type="text" hidden="hidden" name="recommentname" value="<?=$onerecomment->replyer?>">
                                <textarea rows="3" name="recommentcontent" style="width: 100%;margin-bottom: 10px"></textarea>
                                <button type="submit" class="btn">回复</button>
                            </form>
                        </div>
                    <?php }}; ?>
                </div>
            </div>
            <?php }?>
            <br>
            <div class="comment-add">
                <p><button type="button"class="btn createcomment">我有看法</button></p>
                <div class="recomment-hide">
                    <form method="post" action="?r=test/add-recomment">
                        <input type="text" hidden="hidden" name="chapterid" value="<?=$model->id?>">
                        <input type="text" hidden="hidden" name="commentid" value="<?=$comment->id?>">
                        <input type="text" hidden="hidden" name="commentname" value="<?=$comment->replyer?>">
                        <textarea rows="3" name="recommentcontent" style="width: 100%;margin-bottom: 10px"></textarea>
                        <button type="submit" class="btn">提交</button>
                    </form>
                </div>
            </div>
            <br>
            <div>
                <?php if(hash('sha256',$comment->comment)==$best){?>
                <a href="javascript:" class="btn btn-danger">神评</a>
                <?php }else{?>
                <a href="<?php echo \yii\helpers\Url::toRoute(['best-answer','id'=>$comment->id])//,'test'=>'test'])?>" class="btn btn-success">设为神评</a>
                <?php }?>
            </div>
            <hr/>
        </div>
        <?php };?>
    </div>
    <?=LinkPager::widget(['pagination'=>$commentpage]);?>
    <?php if($model->bestanswer!=""):?>
        <div class="chat">
            <div class="bestanswer">
                <div class="nav" style="float: left">
                    <span class="glyphicon glyphicon-star"></span>
                    <span>神回复</span>
                </div>
                <div class="nav" style="float: right">
                    <span class="glyphicon glyphicon-user"></span>
                    <span><?=Html::encode($model->answername)?></span>
                </div>
                <!--            span是行内元素，不会另起一行-->
                <!--            div是块级元素两个div会另起一行-->
            </div>
            <div class="chatmessage">
                <?=Html::encode($model->bestanswer) ?>
            </div>
        </div>
    <?php endif;?>
    <br/>
    <div class="foot">
        <div id="" class="nav count" style="float: left">
            <a href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-up">&nbsp;</span></a><span class="line" style="vertical-align: top">12&nbsp;&nbsp;</span>
            <a href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-down">&nbsp;</span></a><span style="vertical-align: top">50&nbsp;&nbsp;</span>
        </div>
        <div class="nav" style="float: right">
            <a href="?r=test/comment&id=<?=$model->id?>"><span class="glyphicon glyphicon-comment">&nbsp;</span></a><span style="vertical-align: top"><?=$model->totalcomment?>&nbsp;&nbsp;</span>
            <a href="javascript:void(0)"><span class="glyphicon glyphicon-share">&nbsp;</span></a><span style="vertical-align: top">分享</span>
        </div>
    </div>
    <div class="addcomment">
            <span class="sr-only"><?=$model->id?></span>
            <div style="height: 50px">
                <textarea rol="3" placeholder="评论" id="addcomment" class="form-control" style="width: 60%;float: left"></textarea>
                <button type="button" class="btn btn-default btn-primary btn-lg commentsubmit" style="float: left">回复</button>
            </div>
    </div>
</div>