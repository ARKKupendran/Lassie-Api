<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pet_category".
 *
 * @property int $pet_cat_id
 * @property string $category_name
 * @property int $created_at
 * @property int $updated_at
 */
class PetCategory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pet_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['created_at', 'updated_at','status'], 'integer'],
            [['category_name','category_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pet_cat_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_image' => 'Category Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
