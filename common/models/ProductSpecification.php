<?php

namespace common\models;

/**
 * This is the model class for table "{{%product_specification}}".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int|null $product_id
 * @property int|null $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Product $product
 */
class ProductSpecification extends \yii\db\ActiveRecord
{
    //statuses
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_specification}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'value'], 'string', 'max' => 255],
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
            'value' => 'Value',
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

    /**
     * @return string[]
     */
    public static function getStatusNames()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return self::getStatusNames()[$this->status];
    }
}
