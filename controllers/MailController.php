<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/29
 * Time: 15:05
 */
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\mail;
use sendmail;
use yii\web\UploadedFile;//上传文件需要的
use app\models\Setting;//获取数据库信息
class MailController extends Controller
{
    public function actionIndex()
    {
        $message=true;
        $model = new mail();
        if ($model->load(Yii::$app->request->post()))
        {
            $mailaccount = Setting::find()->one();
            $sendhost = $mailaccount->sendhost;
            $username = $mailaccount->username;
            $user = $mailaccount->user;
            $password = $mailaccount->password;
            error_reporting(E_ALL^E_WARNING);
            $request = Yii::$app->request;
            $body = $request->post();
            $to=$model->receiver;
            $subject=$model->subject;
            $model->file =UploadedFile::getInstance($model, 'file');
            if($model->file!=null)
            {
                $filename=$model -> file -> name;
                $encode = mb_detect_encoding($filename,array("ASCII","UTF-8","GBK","GB2312"));
                if($encode=="EUC-CN")
                    $encode="GB2312";
                if($encode!="GBK")
                    $filename = iconv($encode,"GBK//IGNORE",$filename);
                echo $filename."before save"."</br>";
                if($model->file->saveAs('c:/sendattachment/' .$filename))
                {
                    $mail = new sendmail();//新建发送
                    $mail->setServer($sendhost, $user, $password);
                    $mail->setFrom($username);
                    $mail->setReceiver("$to");
                    $mail->setMailInfo($subject,$body['body'],'c:/sendattachment/'.$filename);
                    $message=true;
                    if(!$mail->sendMail())
                        $message=false;
                    return $this->render('index', ['model' => $model,'message'=>$message]);
                }
            }
            else
            {
                $mail = new sendmail();//新建发送
                $mail->setServer($sendhost, $user, $password);
                $mail->setFrom($username);
                $mail->setReceiver("$to");
                $mail->setMailInfo($subject,$body['body'],"");
                if(!$mail->sendMail())
                    $message=false;
                    return $this->render('index', ['model' => $model,'message'=>$message]);
            }
        }
        else
            return $this->render('index', ['model' => $model]);
    }

}