<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (Helper::checkRoute('create')) {
                echo Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'class' => 'yii\grid\SerialColumn',
              'header'=> '序号',
            ],

            'id',
            'title',
            'content:ntext',
            'create_time',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => Helper::filterActionColumn('{view}{update}{delete}'),
            ],
        ],
    ]); ?>
</div>
