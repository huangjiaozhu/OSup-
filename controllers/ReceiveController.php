<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/3
 * Time: 14:46
 */
namespace app\controllers;
use app\models\Receive;
use Yii;
use yii\web\Controller;
use app\models\setting;
use receiveMail;

header("Content-type;text/html;charset=UTF-8");
error_reporting(E_ALL||~E_WARNING||~E_NOTICE);
class ReceiveController extends Controller
{
    public function actionIndex()
    {
        $model = new Receive;
        $mailaccount = setting::find()->one();
        $user = $mailaccount->user;
        $password = $mailaccount->password;
        $username = $mailaccount->username;
        $receivehost = $mailaccount->receivehost;
        $receiveapply = "imap";
        $receiveport = $mailaccount->receiveport;
        $obj = new receiveMail($user,$password,$username,$receivehost,$receiveapply,$receiveport,'ture');
        $obj->connect();
        $tot = $obj->getTotalMails();
        for ($i = $tot; $i > $tot-5; $i--) {

            $model = new Receive;
            $head = $obj->getHeaders($i);
//            var_dump($head);
            $head['subject'] = imap_mime_header_decode($head['subject'])[0]->text;
            $head['from'] = imap_mime_header_decode($head['from'])[0]->text;
            $head['fromName'] = imap_mime_header_decode($head['fromName'])[0]->text;
            $attachments = $obj->GetAttach($i,"c:/receiveattachment");
            $attach="";
            if($attachments!="") {
                $attach = $attachments;
                var_dump($attach);
                $encode = mb_detect_encoding($attachments, array("ASCII", "UTF-8", "GB2312", "GBK", "BIG5", "EUC-CN"));
                if ($encode == "EUC-CN")
                    $encode = "GB2312";
                if ($encode != "UTF-8")
                    $attach = iconv("$encode", "UTF-8//IGNORE", $attachments);
            }
var_dump($attach);
                $model->subject=$head['subject'];
            $model->sender=$head['from'];
//            echo $i.$head['date']."</br>";
//            echo $i.strtotime($head['date'])."</br>";
//            echo $i.date("Y-m-d H:i:s",strtotime($head['date']))."</br>";
            $model->sendtime=date("Y-m-d H:i:s",strtotime($head['date']));
            $model->text=$obj->getBody($i);
            $model->attachment = $attach;
            var_dump($model);
//            $model->sendtime=$head['date'];
            $model->save();
//            echo $i.$head['date'];
        }
        $obj->close_mailbox();
    }
}

