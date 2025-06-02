<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Order extends AppModel
{
    public function get_orders($start, $perpage, $status): array
    {
        if ($status) {
            return R::getAll("SELECT *
                FROM orders
                WHERE $status
                ORDER BY id DESC
                LIMIT $start, $perpage");
        }
        return R::getAll("SELECT *
            FROM orders
            ORDER BY id DESC
            LIMIT $start, $perpage");
    }
}
