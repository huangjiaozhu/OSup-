<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 20:46
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<html>
<head>
    <title>分发</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="icon" href="/img/favicon.ico">
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/handle.js"></script>
    <script src="/js/write.js"></script>
    <script src="/js/chuli.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" id="nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="container-fluid" >
                <div class="navbar-header" style="margin-left:20px;">
                    <a class="navbar-brand" id="logo" href="#">
                        <img alt="Brand" src="/img/logo.png">
                    </a>
                </div>
                <a class="navbar-brand" href="#" style="margin-left:0px;">EmailOS</a>
            </div>

        </div>
        <div id="navbar" class="navbar-collapse collapse ">
            <ul class="nav navbar-nav navbar-right">
                <li><a herf="#"><?php session_start();echo $_SESSION['user']['username']?></a></li>
                <li><a id="nav-close" href="http://localhost/index.php?r=login/logout">注销</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!--nav sidebar-->
        <div  class="col-sm-3 col-md-2 sidebar">
            <!--            <div class="col-md-2 sidebar">-->
            <ul class="nav nav-sidebar ">
                <li class="active">
                    <a href="http://localhost/index.php?r=check/index">
                        <i class="glyphicon glyphicon-th-list"></i>
                        <span class="title">&nbsp;&nbsp;邮件列表</span>
                        <span class="sr-only">(current)</span>
                        <span class="badge pull-right">155</span>
                    </a>
                </li>
                <li>
                    <a href="#" id="write">
                        <i class="glyphicon glyphicon-edit"></i>
                        <span class="title">&nbsp;&nbsp;写邮件</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-ok-circle"></i>
                        <span class="title">&nbsp;&nbsp;已发送</span>
                    </a>
                </li>

                <li>
                    <a href="mail.html">
                        <i class="glyphicon glyphicon-eye-open"></i>
                        <span class="title">&nbsp;&nbsp;审核邮件</span>
                        <i class="glyphicon glyphicon-chevron-up pull-right"></i>
                    </a>
                    <ul class="submenu">

                        <li>
                            <a href="#">
                                <span class="title">&nbsp;&nbsp;未通过</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="title">&nbsp;&nbsp;待审核</span>
                            </a>
                        </li>
                        <li id="subdivider">
                            <a href="#">
                                <span class="title">&nbsp;&nbsp;已通过</span>
                            </a>
                        </li>

                    </ul>
                </li>

                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="title">&nbsp;&nbsp;通讯录</span>


                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
            <!--panel-->
            <div id="content">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);; ?>
                        <?php $js=<<<JS
                        var editor;
                        KindEditor.ready(function(K) {
                              editor = K.create('textarea[name="body"]', {
                                        allowFileManager : true,
                                        afterBlur: function(){this.sync();}
                              });
                        });
JS;
                        $this->registerJs($js);
                        $this->registerCssFile('libs/kindeditor/themes/default/default.css');
                        $this->registerJsFile('libs/kindeditor/kindeditor-min.js');
                        $this->registerJsFile('libs/kindeditor/lang/zh_CN.js');
                        ?>
                        <div class="form-group">
                        <?= $form->field($model, 'subject')->textInput(['maxlength' => 20, 'class' => 'form-control'])->label("主题：") ?>
                        </div>
                        <div class="form-group">
                        <?= $form->field($model, 'receiver')->textInput(['maxlength' => 20, 'class' => 'form-control'])->label("收件人：")  ?>
                        </div>
                        <div class="form-group">
                        <?= $form->field($model, 'body')->textArea(['name'=>'body', 'class' => 'form-control'])->label("内容:") ?>
                        </div>
                        <br/>
                        <?= $form->field($model, 'file')->fileInput() ?>
                        <?php if(isset($message)&&$message==true) echo"<p style='color: green'>发送成功</p>";else if(isset($message)&&$message==false) echo"<p style='color:red' >发送失败</p>"?>
                        <?= Html::submitButton('发送', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


