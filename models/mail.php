<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/29
 * Time: 14:44
 */

namespace app\models;
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require_once(__DIR__).'/../vendor/sendmail.php';
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
class Mail extends ActiveRecord
{
    public $sender;
    public $receiver;
//    public $text;
//    public $smtp;
//    public $cc;
    public $file;
   public $subject;
    public $body;
//    public $sendtime;
    public static function tableName(){
        return "mailsetting";
    }
    public function rules()
    {
        return [
            ['sender', 'filter', 'filter' => 'trim'],
            [['sender', 'receiver','subject'], 'required'],
            ['file','file'],
            ['receiver','email']

        ];
    }
}