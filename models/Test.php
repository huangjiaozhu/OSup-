<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/19
 * Time: 18:47
 */
namespace app\models;
use yii\db\ActiveRecord;
class Test extends ActiveRecord{
    public static function tableName()
    {
        return "test";
    }

    public function getComments(){
        return $this->hasMany(Comment::className(),['test_id'=>'id'])->orderBy('commentdate');
}
}