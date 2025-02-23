<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

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
            'name',
            'author',
            [
                'attribute' => 'category_id',
                'value' =>  $model->category ? $model->category->name : '',
            ],
            'description:ntext',
            'pages',
            [
                'attribute' => 'availability',
                'value' =>  $model->getAvailabilityText(),
            ],
            'image',
        ],
    ]) ?>

    <p><img class = "img-preview" src="<?=Yii::$app->homeUrl . 'uploads/images/' . $model->image?>"></p>
    
</div>
