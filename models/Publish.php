<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/20
 * Time: 20:54
 */

namespace app\models;
use yii\db\ActiveRecord;


class Publish extends ActiveRecord{
//    public $author;
//    public $author_img;
    public $img;
    public $content;
    public static function tableName()
    {
        return 'test';
    }

    public function rules()
    {
        return [
            ['content','required','message'=>"内容不能为空"]
        ];
    }

    public function attributeLabels()
    {
        return [
            'content'=>"内容:",
        ];
    }
}