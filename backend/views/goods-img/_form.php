<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsImg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-img-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'goods_id')->textInput() ?>

    <?php
    $img_url = $model->url ?: '';
    echo $form->field($model, 'url')->label('image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => $img_url,
            'initialPreviewConfig' => [
                ['caption' => $img_url, 'url' => 'delete-url', 'key' => 'delete-url-id'],
            ],
            'previewSettings' => [
                'image' => [
                    'width' => '120px',
                    'height' => '120px',
                ],
            ],
            'initialPreviewAsData'=>true,
            'initialCaption'=>$img_url,
            'overwriteInitial'=>false,
            'maxFileSize'=>2800,
            // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
            'showRemove' => false,
            // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
            'showUpload' => false,
            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
            'showBrowse' => true,
            // 展示图片区域是否可点击选择多文件
            'browseOnZoneClick' => true,
            // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
            'fileActionSettings' => [
                // 设置具体图片的查看属性为false,默认为true
                'showZoom' => true,
                // 设置具体图片的上传属性为true,默认为true
                'showUpload' => true,
                // 设置具体图片的移除属性为true,默认为true
                'showRemove' => true,
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $('#goodsimg-url').on('fileselect', function(event, numFiles, label) {
            console.log("fileselect");
        });
    </script>

</div>
