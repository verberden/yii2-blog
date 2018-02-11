<?php

namespace app\controllers;

use Yii;
use app\models\users\UsersRecord;
use app\models\users\UsersSearchModel;
use app\models\posts\PostsRecord;
use app\models\posts\PostsSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;

/**
 * UsersController implements the CRUD actions for UsersRecord model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['view','delete', 'update'],
                'rules' => [
                    [
                        'actions' => ['view','delete', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UsersRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersRecord model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $data = UsersRecord::getOneUserPosts($id);


        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $rows_s= (new \yii\db\Query())
            ->select(['users.id as u_id', 'users.username','users.email','posts.title','posts.body','posts.id'])
            ->from('users')
            ->leftJoin('posts', 'posts.user_id = users.id')
            ->where(['users.id'=>$id]);//->all()

        /*UsersRecord::find()
            ->With('posts')
            ->where(['users.id'=>$id]),*/

        $provider_p =  new ActiveDataProvider([
            'query' =>$rows_s,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        $r=UsersRecord::findOne($id);
        //$p=$r->posts;
        /*$p=UsersRecord::find()
            ->With('posts')
            ->where(['users.id'=>$id])
            ->all();*/
        //echo gettype($p);
        //vd($p[0]->posts[1]->id);
        //vd($provider_p);
        //vd($q=$this->findModel($id)->getPosts());
        //vd($rows_s);
        return $this->render('view', [
            'model' => $provider_p,//$p,//$this->findModel($id),
            'data' => $r,
        ]);
    }

    /**
     * Creates a new UsersRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersRecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->renderPartial('create', [
            'model' => $model,
        ]);
        /*return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing UsersRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);


        if ($this->findModel($id)->id == Yii::$app->user->id) {//авторизованный пользователь является пользователем профайла

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        } else
            throw new NotFoundHttpException('You have no permission.');

    }

    /**
     * Deletes an existing UsersRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->id == Yii::$app->user->id) {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        } else
            throw new NotFoundHttpException('You have no permission.');
    }

    /**
     * Finds the UsersRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersRecord::findOne($id)) !== null) {
        //if (($model = UsersRecord::find()->with('posts')->where(['id'=>$id])->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
