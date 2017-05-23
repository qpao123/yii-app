<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvList */

$this->title = 'Update Adv List: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adv Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adv-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
