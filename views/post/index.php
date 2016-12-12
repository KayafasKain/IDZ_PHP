<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'overwiew_txt',
            //'full_txt',
            [
                'attribute' => 'img_link',
                'label' => 'Image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img("IDZ/"."../../web/".$data['img_link'],
                        ['width' => '200px', 'height' => '200px']);
                },
            ],            
            // 'video_link',
            [
                'attribute' => 'status',
                'value' => 'StatName',
                'filter' => array("0"=>"Visible", "1"=>"Hidden"),
            ],             
            // 'category_id',
            [
                'attribute' => 'user_id',
                'value' => 'user.name',
                'filter'=>ArrayHelper::map(User::find()->asArray()->orderBy('name')->all(), 'id', 'name'),
            ],             
            'change_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
