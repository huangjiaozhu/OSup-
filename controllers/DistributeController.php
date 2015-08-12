<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/6/28
 * Time: 20:42
 */
namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Distribute;
use app\models\Relation;
use app\models\Login;
use sendmail;
class DistributeController extends Controller
{
    public function actionIndex()
    {

        $query = Distribute::find();
        $total = Distribute::find()->where('handle_status'==0);
        $count = $total->count();
        $pagination = new Pagination([
            'defaultPageSize' => 14,
            'totalCount' => $query->count(),
        ]);
        $user = Login::find()->asArray()->all();
        $res = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $session = Yii::$app->session;
        if (!$session->isActive)
        $session->open();
        if($session['user']==null||$session['user']['permission']!=2)
        {
            return $this->redirect('?r=login');
        }
        return $this->render('index', [
            'res'=>$res,
            'pagination' => $pagination,
            'count' =>$count,
            'user' =>$user,
        ]);
    }
    public function actionHandle()
    {
        if (Yii::$app->request->post())
        {
            $request = Yii::$app->request;
            $id = $request->post('id');
            $result = Distribute::find()->where(['id'=>$id])->one();
           $result->handle_status = 1;
            $result->save();
            echo $result->id.$result->handle_status;
            //return $this->redirect('?r=distribute/index');
        }

    }
    public function actionInsert()
    {
        if (Yii::$app->request->post())
        {
            $msg = "";
            $request = Yii::$app->request;
            $emailId = $request->post('emailid');
            $userId = $request->post('userid');
            $result = Relation::find()->where(['user_id'=>$userId,'email_id'=>$emailId])->one();
            if($result==null)
            {
                $model = new Relation;
                $model ->user_id = $userId;
                $model ->email_id = $emailId;
                $model ->save();
                $msg = "成功分发";
            }
            else
                $msg = "分发失败,可能已经分发过了";
            echo $msg;
        }

    }
}