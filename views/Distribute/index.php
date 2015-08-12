<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 20:46
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
<body>/
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
                <li><a herf="#"><?php echo $_SESSION['user']['username']?></a></li>
                <li><a id="nav-close" href="http://localhost/index.php?r=login/logout" >注销</a></li>
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
                    <a href="http://localhost/index.php/?r=distribute">
                        <i class="glyphicon glyphicon-th-list"></i>
                        <span class="title">&nbsp;&nbsp;收件箱</span>
                        <span class="sr-only">(current)</span>
                        <span class="badge pull-right"><?php echo $count?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-time"></i>
                        <span class="title">&nbsp;&nbsp;紧急邮件提醒</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-ok-circle"></i>
                        <span class="title">&nbsp;&nbsp;已分发</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-cog"></i>
                        <span class="title">&nbsp;&nbsp;未分发</span>
                    </a>
                </li>

                <li>
                    <a href="?r=admin/list">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <span class="title">&nbsp;&nbsp;通讯录</span>
                        <ul id="user">
                            <?php foreach($user as $one)
                            echo "<li>".$one['name']."</li>"?>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>
        <!-- table-->
<!--        <div class="col-md-10 main">-->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
            <!--panel-->
            <div id="content">
                <div class="rs-dialog" id="myModal1">
                    <form name="form1">
                        <div class="rs-dialog-box">
                            <a class="close" href="#">&times;</a>
                            <div class="rs-dialog-header">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">分发至</span>
                                    <input type="text" name="allName" id="allName" class="form-control" placeholder="请在下方选择相应人员或者输入名字" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            <div class="rs-dialog-body">
                                <div class="row" style="font-size:20px;font-weight:bold;">
                                    <div class="col-md-10 col-md-offset-1">
                                        <select id="friendGroups" name="friendGroups" class="form-control">
                                            <option value="0">所有职员</option>
                                            </select>
                                        </div>
                                    <div class="col-md-10 col-md-offset-1" >
                                        <select class="form-control" id="friends" name="friends"  style="font-size:15px;height:180px;" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="rs-dialog-footer">
                                <input type="button" class="btn btn-success" id="tijiao" value="确定" style="float:right">
                                <input type="button" class="close" value="取消" style="float:right">
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-th-list"></i>
                            邮件列表
                        </h3>
                    </div>

                    <div class="panel-body">
                        <div class="page-header" id="table-divider">
                            <!--checkbox-->

                        </div>

                        <!--information table context-->
                        <div class="form bidform">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr >
                                    <th>选中</th>
                                    <th>发件人</th>
                                    <th>邮件主题</th>
                                    <th>状态</th>
                                    <th>标签</th>
                                    <th>发送时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($res as $mail): ?>
                                    <tr>
                                        <td><input type="checkbox"><span class="sr-only" id="id"><?= Html::encode("{$mail->id}") ?></span></td>
                                        <td><span class="sr-only" id="text"><?= Html::encode("{$mail->text}") ?></span><span id="sender"><?= Html::encode("{$mail->sender}") ?></span></td>
                                        <td><a href="javascript:void(0)"><span id="subject"><?= Html::encode("{$mail->subject}") ?></span></a></td>
                                        <?php
                                            if($mail->handle_status==0)
                                                echo "<td><button type='button' class='btn btn-xs btn-danger'>&nbsp;&nbsp;未阅读</button></td>";
                                            else if($mail->handle_status==1)
                                                echo "<td><button type='button' class='btn btn-xs btn-success'>&nbsp;&nbsp;已分发</button></td>"
                                        ?>
                                        <td><?= Html::encode("{$mail->label}") ?>爱睡觉</td>
                                        <td><span id="sendtime"><?= Html::encode("{$mail->sendtime}") ?></span></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                            <?= LinkPager::widget(['pagination' => $pagination]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>


