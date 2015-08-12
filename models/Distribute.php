<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 20:43
 */
namespace app\models;

use yii\db\ActiveRecord;
class Distribute extends ActiveRecord
{
    public static function tableName(){
        return "email";
    }
}