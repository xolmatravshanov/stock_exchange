<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $type
 * @property int $amount
 * @property float $price
 * @property int $customer_id
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $stock_id
 */
class Order extends \yii\db\ActiveRecord
{

    public const type = [
        'sell' => 'sell',
        'buy' => 'buy'
    ];


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'amount', 'price', 'customer_id', 'created_at', 'updated_at'], 'required'],
            [['amount', 'customer_id', 'stock_id'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'amount' => 'Amount',
            'price' => 'Price',
            'customer_id' => 'Customer ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'stock_id' => 'Stock ID',
        ];
    }


    public static function push_order($type = self::type['buy'], $amount = 1, $price, $stock_id, $customer_id, $validation = true)
    {
        $order = new self();
        $order->type = $type;
        $order->amount = $amount;
        $order->price = $price;
        $order->stock_id = $stock_id;
        $order->customer_id = $customer_id;
        if ($order->save($validation)) {
            return $order->getErrors();
        }
        return false;
    }

    public static function get_spread()
    {

        $sell = self::find()->where([
            'type' => Order::type['sell']
        ])->min('price');

        $buy = self::find()->where([
            'type' => Order::type['buy']
        ])->max('price');

        switch (true) {
            case $sell && $buy:
                return $sell->price - $buy->price;

            case $sell:
                return $sell->price;

            case $buy:
                return $buy->price;
        }

    }

    public static function getSpreadByStockId($stock_id)
    {

        $sell = self::find()->where([
            'type' => Order::type['sell'],
            'stock_id' => $stock_id
        ])->min('price');

        $buy = self::find()->where([
            'type' => Order::type['buy'],
            'stock_id' => $stock_id
        ])->max('price');

        switch (true) {
            case $sell && $buy:
                return $sell->price - $buy->price;

            case $sell:
                return $sell->price;

            case $buy:
                return $buy;

        }

    }

    public static function getBuyOrdersByCustomerId($stock_id, $buyer_id)
    {
        $from = date('Y-m-d', strtotime(' -1 day'));

        $to = date("Y-m-d H:i:s");

        $orders =  (new Query())->where([
            'stock_id' => $stock_id,
            'customer_id' => $buyer_id,
            'type' => self::type['buy'],
        ])->andWhere([
            'between', 'created_at', $from, $to
        ])->max('price')->from('order')->all();

        return $orders;

    }

    public static function getSellOrdersByOrderCustomerId($stock_id)
    {

        $from = date('Y-m-d', strtotime(' -1 day'));

        $to = date("Y-m-d H:i:s");

        $orders =  (new Query())->where([
            'stock_id' => $stock_id,
            'customer_id' => $seller_id,
            'type' => self::type['sell'],
        ])->andWhere([
            'between', 'created_at', $from, $to
        ])->min('price')->from('order')->all();

        return $orders;
    }


    public static function random_float($min, $max)
    {
        return ($min + lcg_value() * (abs($max - $min)));
    }


}
