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
    <script src="/js/handle.js"></script>
    <script src="/js/write.js"></script>
    <script type="text/javascript" src="js/chuli.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">

</head>
<body>
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
                        <span class="badge pull-right">3</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/index.php?r=mail/index" id="write">
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
                    <a href="#" id="pull">
                        <i class="glyphicon glyphicon-eye-open"></i>
                        <span class="title">&nbsp;&nbsp;审核邮件</span>
                        <i id="pullico" class="glyphicon glyphicon-chevron-up pull-right"></i>
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
        <!-- table-->
        <!--        <div class="col-md-10 main">-->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
            <!--panel-->
            <div id="content">
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
                        <div class="form">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr >
                                    <th>选中</th>
                                    <th>发件人</th>
                                    <th>邮件主题</th>
                                    <th>标签</th>
                                    <th>发送时间</th>
                                    <th>状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($res as $mail): ?>
                                    <tr>
                                        <td><input type="checkbox"><span class="sr-only" id="id"><?= Html::encode("{$mail['id']}") ?></span></td>
                                        <td><span class="sr-only" id="text"><?= Html::encode("{$mail['text']}") ?></span><span id="sender"><?= Html::encode("{$mail['sender']}") ?></span></td>
                                        <td><a href="javascript:void(0)"><span id="subject"><?= Html::encode("{$mail['subject']}") ?></span></a></td>
                                        <td><?= Html::encode("{$mail['label']}") ?></td>
                                        <td><span id="sendtime"><?= Html::encode("{$mail['sendtime']}") ?></span></td>
                                        <?php
                                        if($mail['handle_status']==0)
                                            echo "<td><button type='button' class='btn btn-xs btn-danger'>&nbsp;&nbsp;未处理</button></td>";
                                        else if($mail['handle_status']==1)
                                            echo "<td><button type='button' class='btn btn-xs btn-success'>&nbsp;&nbsp;已处理</button></td>"
                                        ?>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
<!--                             LinkPager::widget(['pagination' => $pagination]) -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>


