<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\CommentsWidget;

$this->title = $book->name;
?>
<div class="site-index">
    <div class="body-content">
        
            <div class="row center-block">
                <div class="col-md-3 col-md-offset-2 col-xs-6 col-sm-5 col-sm-offset-2">
                    <img class="img-responsive" src="<?=Yii::$app->homeUrl . 'uploads/images/' . $book->image?>">
                </div>
                <div class="col-md-5 col-xs-6 col-sm-5">
                    <h2><?=$book->name?></h2>
                    <p class="card-author"><?=$book->author?></p>
                    <p><?=$book->description?></p>
                    <p><b>Pages: </b><?=$book->pages?></p>
                    <p><b>Availability: </b><?=$book->getAvailabilityText()?></p>
                </div>
            </div>

    </div>
</div>
