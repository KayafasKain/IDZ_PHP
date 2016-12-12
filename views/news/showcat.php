<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;

$this->title = 'News';

?>

<div class="container">

        <div class="container container_category_menu  col-lg-12" >
            
                <?=
                ListView::widget([
                    'dataProvider' => $categoryDataProvider,
                    'summary'=>'',
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'itemView' => 'categories',
                ]);
                ?>
           
        </div>

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'summary'=>'',
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'itemView' => 'viewnews',
                ]);
                ?>
            </div>
        </div>
</div>