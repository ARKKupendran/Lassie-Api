<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pet_breed".
 *
 * @property int $id
 * @property int $main_cat_id
 * @property string $bread_name
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property PetCategory $mainCat
 */
class PetBreed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pet_breed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_cat_id', 'bread_name'], 'required'],
            [['main_cat_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['bread_name'], 'string', 'max' => 255],
            [['main_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => PetCategory::className(), 'targetAttribute' => ['main_cat_id' => 'pet_cat_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_cat_id' => 'Main Cat ID',
            'bread_name' => 'Bread Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainCat()
    {
        return $this->hasOne(PetCategory::className(), ['pet_cat_id' => 'main_cat_id']);
    }
}
