<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/21
 * Time: 9:39
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->$title="发布新消息";
?>

<div class="publishmain" style="background-color: oldlace">
    <?php $form = ActiveForm::begin(['options'=>['role'=>'form','class'=>'form-horizontal','enctype' => 'multipart/form-data']]);?>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <?=$form->field($model,'content')->textarea(['class'=>'form-control','rows'=>'5','placeholder'=>'发布前需要先登录','style'=>'background-color: inherit'])?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    <div class="col-md-5  col-xs-5 ">
                        <a href="javascript:" class="uploadimg">选择文件
                            <?= $form->field($model, 'img')->fileInput(['class'=>''])->label("") ?>
                        </a>
                    </div>
                    <div class=" col-md-7 col-xs-7 ">
                        <div id="uploadimg" class=""><div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 col-md-offset-11 col-xs-2 col-xs-offset-11">
                <?= Html::submitButton('发布', ['class' => 'submitbutton btn btn-default btn-lg']) ?>
            </div>
        </div>
    <?php ActiveForm::end();?>
</div>