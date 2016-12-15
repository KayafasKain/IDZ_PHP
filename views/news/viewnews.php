<?php
use yii\helpers\Html;
?>

<div class="container newscont">
      

            <h2><?= $model->title; ?></h2>

            <div class = "container">
                <img class="col-lg-3 img-responsive" src="/IDZ/web/<?php echo $model->img_link; ?>" alt="Image Not Found">

                <span class="col-lg-9 deskription"> <?= $model->overwiew_txt; ?> </span>  
            </div>

            <span class="subinfo">Author: <a href="<?= yii\helpers\Url::to(['news/showauthorpost', 'id' => $model->user_id]) ?>""> <?= $model->user->name;  ?> </a></span> 

            <span class="subinfo">Category: <a href="<?= yii\helpers\Url::to(['news/showcat', 'id' => $model->category_id]) ?>""> <?= $model->category->name;  ?> </a></span>  

            <span class="subinfo">Last update: <?= $model->change_date; ?></span>  
            <br><br>
            <p><a class="btn btn-default" href="<?= yii\helpers\Url::to(['news/showdetail', 'id' => $model->id]) ?>" role="button">Details...</a></p>

      
</div>