<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/4
 * Time: 15:39
 */
namespace app\models;

use yii\db\ActiveRecord;
class Relation extends ActiveRecord
{
    public static function tableName(){
        return "email_user_rs";
    }
    public  function getUser()
    {
        return $this->hasOne(login::className(), ['id' => 'user_id']);
    }
    public function getEmail()
    {
        return $this->hasMany(Distribute::className(),['id' => 'email_id']);
    }
}