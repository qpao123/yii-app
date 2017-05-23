<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsImg */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Goods Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-img-view">

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
            'goods_id',
            [
                'label'          => 'Url',
                'format'         => 'raw',
                'headerOptions'  => ['class' => 'vertical-middle text-center'],
                'contentOptions' => ['class' => 'vertical-middle text-center'],
                'value'          => function ($item) {
                    return Html::img($item->url, ['width' => 100, 'height' => 100]);
                }
            ],
        ],
    ]) ?>

</div>
