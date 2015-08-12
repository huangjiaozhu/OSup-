<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 20:21
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.ico">

    <title>企业邮件管理系统登录界面</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">


</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" id="logo" href="#">
                        <img alt="Brand" src="/img/logo.png">
                    </a>
                </div>

                <a class="navbar-brand" href="#">EmailOS</a>

            </div>
        </div>

    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <img src="/img/email.png">
        </div>
        <div class="col-md-4 col-md-offset-1">
            <?php $form = ActiveForm::begin(['options'=>['class'=>' form-signin']]); ?>
            <h3 class="form-signin-heading">
                <i class="glyphicon glyphicon-user"></i>&nbsp;用户登录
            </h3>
            <label for="username" class="sr-only">Email address</label>
            <?= $form->field($model, 'username',['labelOptions' => ['label' => ' ','class' => '']])->textInput(['maxlength' => 30,'class'=>'form-control','placeholder'=>'用户名']) ?>
            <?= $form->field($model, 'password',['labelOptions' => ['label' => ' ','class' => '']])->passwordInput(['maxlength' => 20,'class'=>'form-control','placeholder'=>'密码']) ?>
            <?= $form->field($model, 'rememberMe',['labelOptions' => ['value' => ' ','class' => 'form-control']])->checkbox(['label' => '记住我'])?>
            <?= Html::submitButton('提交', ['class' => 'btn btn-lg btn-primary btn-block myfont','value'=>'登&nbsp;录']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- /container -->





<footer class="footer">
    <div class="container">
        <p class="text-muted" align="center">企业邮件管理系统</br></p>
    </div>
</footer>



<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
