<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GoodsImg */

$this->title = 'Create Goods Img';
$this->params['breadcrumbs'][] = ['label' => 'Goods Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-img-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
