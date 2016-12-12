<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

header("Content-Type: text/html; charset=utf-8");
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf8" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'News', 'url' => ['/news/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],

            Yii::$app->user->isGuest ? (
                '<li>'
                . Html::beginForm(['/site/login'], 'post')
                . Html::submitButton(
                    'Login',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'            
                .'<li>'
                . Html::beginForm(['/site/register'], 'post')
                . Html::submitButton(
                    'Register',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>' 

            ) : (
                '<li>'
                . Html::beginForm(['/categories/index'], 'post')
                . Html::submitButton(
                    'Categories CRUD',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'            
                .'<li>'
                . Html::beginForm(['/post/index'], 'post')
                . Html::submitButton(
                    'Posts CRUD',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'            
                .'<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
