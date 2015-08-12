<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 20:13
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\login;
use app\models\Distribute;
class LoginController extends Controller
{
    public function actionIndex()
    {
        $model = new login;
        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        if(isset($session['user']))
           return $this->redirect('?r=test/index');
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
//            error_reporting(E_ALL^E_WARNING);
            $name=$model->username;
            $pwd=$model->password;
            $result = login::find()->where(['username'=>$name,'password'=>$pwd])->asArray()->one();
//            var_dump($result);
//            echo "<hr/>";
//            echo $result['username'].$result['password'];
            if($result!=NULL)
            {
                $session['user']=[
                    'name'=>$result['name'],
                    'permission'=>$result['permission'],
                    'userid'=>$result['id']
                ];
//                var_dump(Yii::$app->controllerPath);
                    return $this->redirect('?r=test/index');
            }
            else {
                return $this->render('index', ['model' => $model]);
            }
        }
        // 无论是初始化显示还是数据验证错误
        return $this->render('index', ['model' => $model]);
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        if(isset($session['user']))
        unset($session['user']);
        return $this->redirect('?r=login/index');
    }
//}
}