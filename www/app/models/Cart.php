<?php

declare(strict_types=1);

namespace app\models;

class Cart extends AppModel
{
    public function get_product(int $id, array $lang): ?array
    {
        $sql = "SELECT p.*, pd.*
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.status = 1
                AND p.id = ?
                AND pd.language_id = ?";
        $res = \RedBeanPHP\R::getRow($sql, [$id, $lang['id']]);
        return $res;
    }
}
