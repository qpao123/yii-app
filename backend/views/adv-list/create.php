<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdvList */

$this->title = 'Create Adv List';
$this->params['breadcrumbs'][] = ['label' => 'Adv Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adv-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
