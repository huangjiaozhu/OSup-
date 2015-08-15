<?php
/**
 * Created by PhpStorm.
 * User: 李洋
 * Date: 2015/7/18
 * Time: 18:38
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Test;
use app\models\Publish;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\models\Login;
use app\models\Comment;
use app\models\Click;
use app\models\Recomment;
use yii\data\Pagination;
class TestController extends Controller{
    public $layout = 'test';//共有部分使用单个layout
    public $enableCsrfValidation = false;//禁用Csrf
    public function actionIndex()
    {
//        $test1 = new testNamespace();//新建一个对象
//        $test1->echo_info();
//        $request = Yii::$app->request;//实例化一个request
//        var_dump($request);
//        $res = Yii::$app->response;
//        $res -> sendFile('./test/ajax.php');
//        $res -> sendFile('./index.php');
//        $session = Yii::$app->session;
//        $result = Test::find()->where(['not in','id',2])->asArray()->all();//不等于等同于not in
//        $data = array();
//        $data['test'] = "test_value";
//        print_r($result);
//        $result = Test::find()->where('id=:id',array(':id'=>2))->asArray()->all();//不等于等同于not in
        $result = Test::find()->orderBy('publishtime DESC')->offset(0)->limit(5)->asArray()->all();
        return $this -> render('index',['data' => $result]);
    }

    public function actionCalculate(){
        $be=array(5,4,3,2,1);
        $xy=array(12,11,10);
        foreach($be as $onebe){
            $e=$onebe;
            $b=5-$e;
            foreach($xy as $onexy){
                $y=$onexy;
                $x=13-$y;
                for($z=4;$z<100;$z++){
                    $c=$z/(4-$x);
                    if(is_int($c)){
                        $d=$e+4-$c;
                        if($d>0){
                            $a=($y-4)/$d;
                            if(is_int($a)&&$a>0)
                        if($z==4+$a*$b){
                            echo "x:$x y:$y z:$z a:$a b:$b c:$c d:$d e:$e<br>";
                        }
                        }
                    }
                }
            }
        }
    }

    //        发布一条消息
    public function actionPublish()
    {

        $model = new Publish;
        if($model -> load(Yii::$app->request->post())&&$model->validate())
        {
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if(!isset($session['user']))
                $this->redirect('?r=login');
            $author = $session['user']['name'];
            $author_id = $session['user']['userid'];
            $query = Login::find()->where('id=:id',[':id'=>$author_id])->one();
            $author_img =$query->image;
            $content = $model -> content;
            $publishtime = date('Y-m-d H:i:s',time());
            $savemodel = new Test;
            $model->img =UploadedFile::getInstance($model, 'img');
            if($model->img!=null)
            {
                $name = $model->img->name;
                $arr = explode('.',$name);
                $filename=hash('sha256',time().($author)).'.'.$arr[count($arr)-1];
                echo "filename:".$filename;
                $model->img->saveAs('./img/' .$filename);
                $savemodel->bodyimg = './img/' .$filename;
            }else{
                $savemodel->bodyimg = "";
            }
            $savemodel->author = $author;
            $savemodel->author_img = $author_img;
            $savemodel->describe = $content;
            $savemodel->publishtime = $publishtime;
            $savemodel -> save();
//            var_dump($savemodel);
            return $this->redirect('r=test');
        }
        return $this -> render('publish',['model' => $model]);
    }

    //加载更多
    public function actionMorechapter()
    {
        if(Yii::$app->request->getIsAjax())
        {
            $defaultpagechapter = 8;
            $request = Yii::$app->request;
            $page = $request->post('chapterpage');
            $query = Test::find()->orderBy('publishtime DESC')->offset(5
                +$page*$defaultpagechapter)->limit($defaultpagechapter)->asArray()->all();
            echo json_encode($query);
        }

    }


    //显示评论
    public function actionComment($id=""){
            $request = Yii::$app->request;
            if($id=="")
                $chapterid = $request->get('id');
            else
                $chapterid = $id;
            $page = is_null($request->get('commentpage'))?$request->get('commentpage'):0;
            $recommentpage = is_null($request->get('recommentpage'))?$request->get('recommentpage'):0;
//            $model = $this->findModel($chapterid);
            $chapter = Test::find()->where('id=:id',[":id"=>$chapterid])->one();
            $best = hash('sha256',$chapter->bestanswer);
            $allcomments = $chapter -> getComments();
            $commentpage = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $allcomments->count()
            ]);
            $comments = $allcomments->offset($commentpage->offset)->limit($commentpage->limit)->with('recomment')->all();
            $recomment = array();
            foreach($comments as $oneComments){
                $onerecomment = $oneComments -> getRecomment($recommentpage)->all();
                array_push($recomment,$onerecomment);
            }
//            print_r($recomment);
            return $this->render('detail',['model'=>$chapter,'comments'=>$comments,'best'=>$best,'recomment'=>$recomment,'commentpage'=>$commentpage]);
//            echo "come here";

    }

    //添加评论
    public function actionAddcomment(){
        if(Yii::$app->request->getIsAjax()&&Yii::$app->request->post('userid')!==""){
            $request = Yii::$app->request;
            $id = $request->post('id');
            $comment = $request->post('comment');
            $replyer = $request->post('replyer');
            $userid = $request->post('userid');
            $query = Login::find()->where('id=:id',[':id'=>$userid])->one();
            $replyer_img = $query->image;
            //更新评论数
//            $updatetest = Comment::find()->where([]);
//        echo $replyer.$comment.$id;
            $model = new Comment;
            $model->replyer = $replyer;
            $model->comment = $comment;
            $model->test_id = $id;
            $model->replyer_img = $replyer_img;
            $model->commentdate = date("Y-m-d H:i:s",time());
            $model->save();
            $updateTest = Test::find()->where('id=:id',[':id'=>$id])->one();
            $temp = $updateTest->totalcomment;
            $updateTest->totalcomment=$temp+1;
            $updateTest->save();
            echo json_encode($temp);
        }
        else
            return $this->redirect('r=login');
//        $session = Yii::$app->session;
//        if(!$session->isActive){
//            $session->open();
//        }
//        $replyer = $session['user']['name'];

    }

    public function actionClick(){
        if(Yii::$app->request->getIsAjax()){
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if(!isset($session['user']))
                $this->redirect('?r=login');
            $user_id = $session['user']['userid'];
            $request = Yii::$app->request;
            $type = $request->post('type');
            $id = $request->post('chapterid');
            $isClick = Click::find()->where('test_id=:id and user_id=:user_id',[':id'=>$id,':user_id'=>$user_id])->one();
            if($isClick==null) {
                $attitudeModel = new Click;
                $attitudeModel->test_id = $id;
                $attitudeModel->user_id = $user_id;
                $attitudeModel->click = $type;
                $attitudeModel->save();
                $updateTest = Test::find()->where('id=:id',[':id'=>$id])->one();
                if($type==1){
                    $temp = $updateTest->countgood;
                    $updateTest->countgood=$temp+1;
                }
                else{
                    $temp = $updateTest->countbad;
                    $updateTest->countbad=$temp+1;
                }
                $updateTest->save();
            }
            else{
                echo "isclick";
            }
        }
    }

    public function actionBestAnswer(){
        if(Yii::$app->request->isGet){
            $request = Yii::$app->request;
            $commentid = $request->get('id');
            $commentquery = Comment::find()->where("id=:id",[":id"=>$commentid])->one();
            $test = $commentquery -> test;
            $replyer = $commentquery->replyer;
            $replyer_img = $commentquery->replyer_img;
            $comment = $commentquery->comment;
            $test->bestanswer = $comment;
            $test->answername = $replyer;
            $test->answerimg = $replyer_img;
            $test->save();
            $result = Test::find()->orderBy('publishtime DESC')->offset(0)->limit(5)->asArray()->all();
            return $this -> render('index',['data' => $result]);
        }
    }

    public function actionRecomment(){
        if(Yii::$app->request->isPost){
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if(!isset($session['user']))
                $this->redirect('?r=login');
            $user_id = $session['user']['userid'];
            $user_name = $session['user']['name'];
            $request = Yii::$app->request;
            $chapterid = $request->post('chapterid');
            $commentid = $request->post('commentid');
            $recommentid = $request->post('recommentid');
            $recommentname = $request->post('recommentname');
            $recommentcontent = $request->post('recommentcontent');
            $recommentmodel = new Recomment();
            $recommentmodel->comment_id = $commentid;
            $recommentmodel->recomment_id = $recommentid;
            $recommentmodel->recomment_name = $recommentname;
            $recommentmodel->replyer = $user_name;
            $recommentmodel->reply_content = $recommentcontent;
            $recommentmodel->reply_time = date("Y-m-d H:i:s",time());
//            var_dump($recommentmodel);
            if($recommentcontent!="")
            $recommentmodel->save();
            return $this->redirect(['comment','id'=>$chapterid]);
        }
    }

    public function actionAddRecomment(){
        if(Yii::$app->request->isPost){
            $session = Yii::$app->session;
            if(!$session->isActive)
                $session->open();
            if(!isset($session['user']))
                $this->redirect('?r=login');
            $user_id = $session['user']['userid'];
            $user_name = $session['user']['name'];
            $request = Yii::$app->request;
            $chapterid = $request->post('chapterid');
            $commentid = $request->post('commentid');
            $commentname = $request->post('commentname');
            $content = $request->post('recommentcontent');
            $recommentmodel = new Recomment();
            $recommentmodel->comment_id = $commentid;
            $recommentmodel->replyer = $user_name;
            $recommentmodel->recomment_name = $commentname;
            $recommentmodel->reply_content = $content;
            $recommentmodel->reply_time = date("Y-m-d H:i:s",time());
            if($content!="")
                $recommentmodel->save();
            return $this->redirect(['comment','id'=>$chapterid]);
        }
    }
    public function actionRank(){
        $result = Test::find()->orderBy('totalcomment DESC')->offset(0)->limit(10)->all();
        return $this -> render('rank',['data' => $result]);
    }

    public function actionBar(){
        return $this->render('bar');
        //ceshi git
    }

    protected function findModel($id){
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}