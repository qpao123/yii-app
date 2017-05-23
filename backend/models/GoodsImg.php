<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "goods_img".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property string $url
 */
class GoodsImg extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['url'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'url' => 'Url',
        ];
    }

    /**
     * 上传文件必须配置两个参数
     *
     * 1. 在 `/common/config/bootstrap.php` 文件中,配置`@uploadPath`的值,例如:`dirname(dirname(__DIR__)) . '/frontend/web/uploads'`
     *
     * 2. 在 `/backend/config/params.php` 文件中,配置`assetDomain`的值,例如:`http://localhost/yii2/advanced/frontend/web/uploads`
     *
     * Class UploadForm
     * @package backend\models
     */
    public function upload()
    {
        $path = Yii::getAlias('@uploadPath') . '/' . date("Ymd");
        if (!is_dir($path) || !is_writable($path)) {
            FileHelper::createDirectory($path, 0777, true);
        }
        $filePath = $path . '/' . md5(uniqid() . mt_rand(10000, 99999999)) . '.' . $this->imageFile->extension;

        if ($this->imageFile->saveAs($filePath)) {
            return $this->parseImageUrl($filePath);
        }

        return false;
    }

    public function AsyncUpload()
    {
        $path = Yii::getAlias('@uploadPath') . '/' . date("Ymd");
        if (!is_dir($path) || !is_writable($path)) {
            \yii\helpers\FileHelper::createDirectory($path, 0777, true);
        }
        $filePath = $path . '/' . md5(uniqid() . mt_rand(10000, 99999999)) . '.' . $this->imageFile->extension;

        if ($this->imageFile->saveAs($filePath)) {
            //这里将上传成功后的图片信息保存到数据库
            $imageUrl = $this->parseImageUrl($filePath);
            $imageModel = new GoodsImg();
            $imageModel->url = $imageUrl;
            $imageModel->goods_id = Yii::$app->request->post('goods_id', '1');

            $imageModel->save();
            $imageId = Yii::$app->db->getLastInsertID();

            return ['imageUrl' => $imageUrl, 'imageId' => $imageId];
        }

        return false;
    }

    /**
     * 这里在upload中定义了上传目录根目录别名，以及图片域名
     * 将/var/www/html/advanced/frontend/web/uploads/20160626/file.png 转化为 http://statics.gushanxia.com/uploads/20160626/file.png
     * format:http://domain/path/file.extension
     * @param $filePath
     * @return string
     */
    private function parseImageUrl($filePath)
    {
        if (strpos($filePath, Yii::getAlias('@uploadPath')) !== false) {
            return Yii::$app->params['assetDomain'] . str_replace(Yii::getAlias('@uploadPath'), '', $filePath);
        } else {
            return $filePath;
        }
    }
}
