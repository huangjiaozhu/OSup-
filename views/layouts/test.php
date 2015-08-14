<?php
if(!isset($_SESSION['user'])) session_start();
//use yii\jui\DatePicker;貌似没有集成
use yii\widgets\Menu;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title><?=\yii\helpers\Html::encode($this->title)?></title>
    <script src="./js/jquery-2.1.4.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link href="./css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="./css/test.css">
</head>
<body>
<div class="tophead">
    <nav class="navbar navbar-default navbar-fixed-top headcolor">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse ">
                <ul class="nav navbar-nav navbar-left menu">
                    <li><a href="?r=test">测试一</a></li>
                    <li><a href="?r=test/publish">测试二</a></li>
                    <li><a href="?r=test/rank">测试三</a></li>
                    <li><a href="?r=test/bar">测试四</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right menu user">
                    <?php if(isset($_SESSION['user'])):?>
                    <li id="sessionuser"><span class="sr-only"><?=$_SESSION['user']['userid']?></span><a><?=$_SESSION['user']['name']?></a></li>
                    <li><a href="?r=login/logout">注销</a></li>
                    <?php endif;?>
                    <?php if(!isset($_SESSION['user'])):?>
                    <li><a href="?r=login">测试三</a></li>
                    <?php endif?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-1 col-xs-12">
                <div class="content">
                    <?= $content; ?>
                </div>
            </div>
            <div class="col-md-4 col-lg-offset-3 col-xs-12">
                <input type="date">
                <div class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <span class="input-group-addon">添加时间</span>
                    <input class="form-control visibletime" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" name="dead_time" /><br/>
                <div>
                    <?=Menu::widget([
                            'activateItems'=>false,
                            'items'=> [
                                ['label'=>'HOME','url'=>'index'],
                                ['label'=>'DETAIL','url'=>'publish'],
                            ],
                        ])
                    ?>
<!--                </div>-->
<!--                <div id="testfont">-->
<!--                    <span class="fa fa-spin fa-spinner fa-4x"></span>-->
<!--                    <span class="fa fa-pulse fa-spinner fa-4x"></span>-->
<!--                    <span class="fa fa-spin fa-refresh fa-4x"></span>-->
<!--                    <span class="fa fa-spin fa-cog fa-4x"></span>-->
<!--                    <span class="fa fa-spin fa-circle-o-notch fa-4x"></span>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>

</body>
<script src="./js/count.js"></script>
<script src="./js/morechapter.js"></script>
<script src="./js/micropic.js"></script>
<script src="./js/addcomment.js"></script>
<script src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script src="./js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script src="./js/rank.js"></script>
<script src="./js/bar.js"></script>
<script src="./js/recomment.js"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>
</html>