<?php


namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use app\models\Categories;
use app\models\CategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {		

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where('status=0')->orderBy('change_date DESC'),
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 5
            ]
        ]);

        $categoryDataProvider = new ActiveDataProvider([
            'query' => Categories::find()->orderBy('name'),
            'pagination' => false
        ]);        

    	return $this->render('index', ['dataProvider' => $dataProvider, 'categoryDataProvider' => $categoryDataProvider]);

    }

    public function actionShowdetail(){

        $id = Yii::$app->request->get('id');
        $model = Post::findOne($id);
        if (empty($model)) throw new HttpException(404, 'Not found!');

        return $this->render('showdetail', ['model' => $model ]);    	
    }

    public function actionShowcat(){
        $id = Yii::$app->request->get('id');

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where('status=0 AND category_id='. $id)->orderBy('change_date DESC'),
            'pagination' => [
	            'forcePageParam' => false,
	            'pageSizeParam' => false,
	            'pageSize' => 5
            ]
        ]);

        $categoryDataProvider = new ActiveDataProvider([
            'query' => Categories::find()->orderBy('name'),
            'pagination' => false
        ]);          


        if (empty($dataProvider)) throw new HttpException(404, 'Not found!');

        return $this->render('showcat', ['dataProvider' => $dataProvider, 'categoryDataProvider' => $categoryDataProvider ]);    	
    }

    public function actionShowauthorpost(){
        $id = Yii::$app->request->get('id');

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where('status=0 AND user_id='. $id)->orderBy('change_date DESC'),
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 5
            ]
        ]);


        $categoryDataProvider = new ActiveDataProvider([
            'query' => Categories::find()->orderBy('name'),
            'pagination' => false
        ]);  

        if (empty($dataProvider)) throw new HttpException(404, 'Not found!');

        return $this->render('showcat', ['dataProvider' => $dataProvider, 'categoryDataProvider' => $categoryDataProvider ]);    	
    }  

}
