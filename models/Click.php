<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/8/7
 * Time: 19:26
 */
namespace app\models;
use yii\db\ActiveRecord;


class Click extends ActiveRecord{
    public static function tableName(){
        return "attitude";
    }

    public function getTest(){
//        return $this->hasOne(Comment::className(),['id'=>'test_id']);
    }
}