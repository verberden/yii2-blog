<?php

namespace app\controllers;

use Yii;
use app\models\users\UsersRecord;
use app\models\posts\PostsRecord;
use app\models\posts\PostsSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostsController implements the CRUD actions for PostsRecord model.
 */
class PostsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'delete', 'update'],
                'rules' => [
                    [
                        'actions' => ['create', 'delete', 'update'],
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
     * Lists all PostsRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data = PostsRecord::getCategories();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataCategories' => $data,
        ]);
    }

    /**
     * Displays a single PostsRecord model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $username = ['username' => UsersRecord::findOne($this->findModel($id)->user_id)->username];
        //vd($username);
        $data = PostsRecord::getCategories();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'username' => $username,
            'id' => $this->findModel($id)->user_id,
            'dataCategories' => $data,
        ]);
    }

    /**
     * Creates a new PostsRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = PostsRecord::getCategories();
        $model = new PostsRecord();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if (!empty($model->imageFile)) {
                if (($model->save()) && ($model->upload())) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            //$imageFile = UploadedFile::getInstance($model, 'imageFile');

        }
        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing PostsRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id == Yii::$app->user->id) {//авторизованный пользователь является автором постинга

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
     * Deletes an existing PostsRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if ($this->findModel($id)->user_id == Yii::$app->user->id) {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        } else
            throw new NotFoundHttpException('You have no permission.');
    }

    /**
     * Finds the PostsRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostsRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostsRecord::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

   /* protected function checkPermission($id)
    {
                if ($this->findModel($id)->user_id == Yii::$app->user->id) {

        } else
            throw new NotFoundHttpException('You have no permission.');

    }*/
}
