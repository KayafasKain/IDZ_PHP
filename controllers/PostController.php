<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if( Yii::$app->user->isGuest ){
            throw new MethodNotAllowedHttpException('Please register or log in!');
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        if( Yii::$app->user->isGuest ){
            throw new MethodNotAllowedHttpException('Please register or log in!');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if( Yii::$app->user->isGuest ){
            throw new MethodNotAllowedHttpException('Please register or log in!');
        }

        if ($model->load(Yii::$app->request->post())) {

            $image = rand(rand(),rand()).rand(rand(),rand()).rand(rand(),rand()).Yii::$app->user->identity->getId();

            $model->image = UploadedFile::getInstance($model, 'image');
            if (!empty($model->image)) {
                $model->image->saveAs('upload/images/perviews/' . $image . '.' . $model->image->extension);
                $model->img_link = 'upload/images/perviews/' . $image . '.' . $model->image->extension;
            }

            if( $model->save(false) ){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        if( Yii::$app->user->isGuest ){
            throw new MethodNotAllowedHttpException('Please register or log in!');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            ///IDZ/web/
            $image = rand(rand(),rand()).rand(rand(),rand()).rand(rand(),rand()).Yii::$app->user->identity->getId();

            $model->image = UploadedFile::getInstance($model, 'image');
            if (!empty($model->image)) {

                if(!empty($model->img_link)){
                    unlink(Yii::getAlias('@webroot')."/".$model->img_link);
                }

                $model->image->saveAs('upload/images/perviews/' . $image . '.' . $model->image->extension);
                $model->img_link = 'upload/images/perviews/' . $image . '.' . $model->image->extension;
                $model->save(false);
            }          
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        if( Yii::$app->user->isGuest ){
            throw new MethodNotAllowedHttpException('Please register or log in!');
        }else{

            $model = $this->findModel($id); 

            if (!empty($model->img_link)){
                unlink(Yii::getAlias('@webroot')."/".$model->img_link);
            }
            $model->delete();

            return $this->redirect(['index']);
                
        }


    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
