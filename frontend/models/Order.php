<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_customer
 * @property integer $id_seamstres
 * @property string $date_orders
 * @property string $description
 * @property string $date_try
 * @property string $cost
 * @property integer $status
 *
 * @property Customer $idCustomer
 * @property Seamstress $idSeamstres
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_customer',  'description'], 'required'],
            [['id_customer', 'id_seamstres', 'status'], 'integer'],
            [['date_orders', 'date_try'], 'safe'],
            [['description'], 'string'],
            [['cost'], 'number'],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['id_customer' => 'id']],
            [['id_seamstres'], 'exist', 'skipOnError' => true, 'targetClass' => Seamstress::className(), 'targetAttribute' => ['id_seamstres' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_customer' => 'Id Customer',
            'id_seamstres' => 'Id Seamstres',
            'date_orders' => 'Date Orders',
            'description' => 'Description',
            'date_try' => 'Date Try',
            'cost' => 'Cost',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'id_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSeamstres()
    {
        return $this->hasOne(Seamstress::className(), ['id' => 'id_seamstres']);
    }
}