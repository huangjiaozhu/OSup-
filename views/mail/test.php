<?php $form = ActiveForm::begin(); ?>
<?php $js=<<<JS
                        var editor;
                        KindEditor.ready(function(K) {
                              editor = K.create('textarea', {
                                        allowFileManager : true,
                                        afterBlur: function(){this.sync();}
                              });
                        });
JS;
$this->registerJs($js);
?>
<?= $form->field($model, 'subject')->textInput(['maxlength' => 20])->label('主题：') ?>
<?= $form->field($model, 'sender')->textInput(['maxlength' => 20])->label('发件人：') ?>
<?= $form->field($model, 'receiver')->textInput(['maxlength' => 20])->label('收件人：')  ?>
<?= $form->field($model, 'body')->textArea(['name'=>'body','style'=>'width:250px;height:50px;'])->label('内容:') ?>
    <br/>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>