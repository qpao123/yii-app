<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "adv_list".
 *
 * @property integer $id
 * @property string $img
 * @property string $link
 * @property integer $sort
 */
class AdvList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adv_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['img', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'link' => 'Link',
            'sort' => 'Sort',
        ];
    }
}
