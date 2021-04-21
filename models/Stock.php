<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property string $codec
 * @property string $name
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codec', 'name'], 'required'],
            [['codec', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codec' => 'Codec',
            'name' => 'Name',
        ];
    }

    public static function createStock($name, $codec)
    {
        $stock = new self();
        $stock->name = $name;
        $stock->codec = $codec;

        if ($stock->save()) {
            return true;
        }
        return false;
    }


}
