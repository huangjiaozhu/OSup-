<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/4
 * Time: 21:22
 */
namespace app\models;

use yii\db\ActiveRecord;
class Check extends ActiveRecord
{
    public $subject;
    public $sender;
    public $receiver;
    public $body;
    public static function tableName(){
        return "email";
    }
    public function rules()
    {
        return [
            ['sender', 'filter', 'filter' => 'trim'],
            [['receiver', 'subject','body'], 'required'],
            ['receiver','email'],
        ];
    }
}