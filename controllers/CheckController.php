<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/4
 * Time: 16:20
 */
namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Distribute;
use app\models\Relation;
use app\models\login;
use app\models\mail;
class CheckController extends Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        if($session['user']==null||$session['user']['permission']!=3)
        {
            return $this->redirect('?r=login');
        }
        else
        {
            $userId = $session['user']['userid'];
        }
        $sql = "select email.id,email.subject,email.sender,email.receiver,email.text,email.label,email_user_rs.handle_status,email.check_status,email.sendtime,email.attachment  from user,email_user_rs,email where user.id = email_user_rs.user_id and user.id = $userId and email.id=email_user_rs.email_id order by email.handle_status";
        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryAll();
        return $this->render('index',['res'=>$result,]);
//        $user = login::find()->where(['id'=>$userId])->one();
////        print_r($user);
//        $temp = $user->rel;
//       $result = $temp->mail;
//        var_dump($result);
//        $pagination = new Pagination([
//            'defaultPageSize' => 14,
//            'totalCount' => count($result),
//        ]);
//        $res = $result->orderBy('handle_status')
//            ->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//        return $this->render('index', [
//            'res'=>$res,
//            'pagination' => $pagination,
//        ]);
    }
//    public function actionWrite()
//    {
//        $model = new mail;
//        if ($model->load(Yii::$app->request->post()) && $model->validate())
//        {
//
//        }
//        else
//        {
//        return $this->render('index', ['model' => $model]);
//        }
//    }
}