<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

use app\models\Categories;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overwiew_txt')->textarea(['maxlength' => true, 'rows' => 3]) ?>


    <?= $form->field($model, 'full_txt')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>


    <?= $form->field($model, 'image')->fileInput() ?>

    

    <?= $form->field($model, 'status')->radioList([
            '0' => 'Visible',
            '1' => 'Hidden',
        ]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Categories::find()->all(), 'id', 'name'),
        ['prompt'=>'Category...']);
    ?>


    <?php if(!$model->user_id || $model->user_id == Yii::$app->user->identity->getId()){ ?>
        <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->getId()])->label(false) ?>
    <?php } else {?>
        <?= $form->field($model, 'user_id')->hiddenInput(['value' => $model->user_id])->label(false) ?>
    <?php }?>      
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
