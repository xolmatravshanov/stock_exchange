<?php
/*
 *
 */

namespace app\commands;

use app\models\Order;
use app\models\Stock;
use Faker\Factory;
use yii\console\Controller;

/**
 *
 */
class FillerDatabaseController extends Controller
{


    public function options($actionID)
    {

    }

    public function actionCreateStock()
    {

        $stock = new Stock();
        $stock->codec = 'USD-EUR';
        $stock->name = 'USD-EUR';
        $stock->save();

    }

    public function actionOrderCreate()
    {

        $i = 0;

        while ($i < 10) {

            $amount = random_int(2, 100);

            Order::push_order(Order::type['buy'], $amount, Order::random_float(10, 60), 1, $amount, false);

            Order::push_order(Order::type['sell'], $amount, Order::random_float(10, 60), 1, $amount, false);

            $i++;

        }

    }


    public function actionCreateTransaction()
    {

    }

}
