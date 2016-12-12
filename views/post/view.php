<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'overwiew_txt',
            'full_txt',
            [
                'attribute' => 'img_link',
                'value' => "IDZ/"."../../web/".$model->img_link,
                'format' => ['image',['width'=>'400','height'=>'400']],
            ],           
            //'video_link',
            [
                'attribute' => 'status',
                'value' => $model->StatName,
            ],
            [
                'attribute' => 'category_id',
                'value' => $model->category->name,
            ],
            //'user_id',
            [
                'attribute' => 'user_id',
                'title' => 'Author',
                'value' => Yii::$app->user->identity->getName($model->user_id),
            ],
            'change_date',
        ],
    ]) ?>

</div>
