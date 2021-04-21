<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $seller_id
 * @property int $buyer_id
 * @property int $amount
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'amount', 'price', 'created_at', 'updated_at'], 'required'],
            [['seller_id', 'buyer_id', 'amount'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seller_id' => 'Seller ID',
            'buyer_id' => 'Buyer ID',
            'amount' => 'Amount',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function process($stock_id)
    {
        /// sell order larni eng arzonlarlarini topib  sotib olish kerak agar
        /// buy order narxi kichik yoki teng bo'lsa

        $sellOrders = Order::getSellOrdersByOrderCustomerId($stock_id);

        // $buyer_id = Yii::$app->user->id;

        $buyOrders = Order::getBuyOrdersByCustomerId($stock_id, 43);
        foreach ($buyOrders as $buyOrder) {
            foreach ($sellOrders as $sellOrder){
                if($sellOrder['price'] <= $buyOrder['price']){
                        $transaction  = new self();
                        $transaction->seller_id = $sellOrder['customer_id'];
                        $transaction->buyer_id = $buyOrder['customer_id'];
                        $transaction->amount = $buyOrder['amount'];
                        $transaction->price = $buyOrder['price'];
                        $transaction->save();
                }
            }
        }
    }
}
