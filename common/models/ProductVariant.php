<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_variant}}".
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string|null $image
 * @property int|null $product_id
 * @property int|null $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Product $product
 */
class ProductVariant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_variant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'display_name'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'display_name', 'image'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'display_name' => 'Display Name',
            'image' => 'Image',
            'product_id' => 'Product ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
