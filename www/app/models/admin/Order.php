<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;
use Exception;

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

    public function get_order($id): array
    {
        return R::getAll("SELECT o.*, op.*
            FROM orders o
            JOIN order_product op
                ON o.id = op.order_id
            WHERE o.id = ?", [$id]);
    }

    public function change_status($id, $status): bool
    {
        $status = ($status == 1) ? 1 : 0;
        R::begin();
        try {
            R::exec("UPDATE orders SET status = ? WHERE id = ?", [$status, $id]);
            R::exec("UPDATE order_download SET status = ? WHERE order_id = ?", [$status, $id]);
            R::commit();
            return true;
        } catch (Exception $e) {
            R::rollback();
            return false;
        }
    }
}
