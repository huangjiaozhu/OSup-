
<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/9
 * Time: 9:42
 */
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
    <script src="/js/showemail.js"></script>
    <script src="/js/distribute.js"></script>
    <script src="/js/chuli.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-th-list"></i>
                联系人列表
            </h3>
        </div>
<div class="form">
    <table class="table table-striped table-bordered">
        <thead>
        <tr >
            <th>用户名</th>
            <th>昵称</th>
            <th>性别</th>
            <th>年龄</th>
            <th>个人邮箱</th>
            <th>电话</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($totaluser as $user): ?>
            <tr>
                <td><?= Html::encode("{$user['username']}") ?></td>
                <td><?= Html::encode("{$user['name']}") ?>
                <td><?php echo ($user['sex']==1)?"男":"女"?></td>
                <td><?= Html::encode("{$user['sex']}") ?></td>
                <td><?= Html::encode("{$user['pmail']}") ?></td>
                <td><?= Html::encode("{$user['phone']}") ?></span></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
</div>
    </div>
</body>
</html>