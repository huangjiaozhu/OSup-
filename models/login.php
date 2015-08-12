<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 19:58
 */

namespace app\models;

use yii\db\ActiveRecord;
class login extends ActiveRecord
{
    public $username;
    public $password;
    public $rememberMe;
    public static function tableName(){
        return "user";
    }
    public function getRel()
    {
        return $this->hasMany(Relation::className(), ['user_id' => 'id']);
    }
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'password'], 'required','message'=>'不能为空'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username','passwordCorrect'],
        ];
    }

    public function passwordCorrect(){
        $user = $this -> find()->where('username=:username and password=:pwd',[':username'=>$this->username,':pwd'=>$this->password])->one();
//        $user = $this->findByUsername($this->username);
        if(!$user)
            $this -> addError('password','用户名或密码错误');
    }
}