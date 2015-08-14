<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/22
 * Time: 18:58
 */
namespace app\models;
use yii\db\ActiveRecord;


class Comment extends ActiveRecord{
    public static function tableName(){
        return "comment";
    }

    public function getTest(){
        return $this->hasOne(Test::className(),['id'=>'test_id']);
    }

    public function getRecomment($page=0){
        return $this->hasMany(Recomment::className(),['comment_id'=>'id'])->offset($page*5)->limit(10)->orderBy('reply_time');
    }
}