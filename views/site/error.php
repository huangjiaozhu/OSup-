<html>
<head>
    <style>
        .move
        {
            width: 100%;
            height: 100%;
            position: relative;
            animation: mytest 10s linear 2s infinite alternate;
        }
        @keyframes mytest
        {
            0%   {background:red; left:0%; top:0%;}
            25%  {background:yellow; left:62%; top:0%;}
            50%  {background:blue; left:62%; top:62%;}
            75%  {background:green; left:0%; top:62%;}
            100% {background:red; left:0%; top:0%;}
        }
    </style>
</head>
<body>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
<div class="row">
    <div class=" move">
        <img src="/img/jiaozhu1.png">
    </div>
<!--    <div class="col-md-4 move">-->
<!--        <img src="/img/jiaozhu2.png">-->
<!--    </div>-->
<!--    <div class="col-md-4 move">-->
<!--        <img src="/img/jiaozhu3.png">-->
<!--    </div>-->


</div>
    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
</body>
</html>