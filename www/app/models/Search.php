<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;

class Search extends AppModel
{
    public function get_count_find_product(string $s, array $lang): int
    {
        $sql = "SELECT COUNT(*)
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.status = 1
                AND pd.language_id = ?
                AND pd.title 
                    LIKE ?";

        $cell = R::getCell($sql, [$lang['id'], "%$s%"]);

        if (is_null($cell)) {
            $count = 0;
        } else {
            $count = (int) $cell;
        }
        return $count;
    }

    public function get_find_products(string $s, array $lang, int $start, int $perpage): array
    {
        $sql = "SELECT p.*, pd.*
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.status = 1
                AND pd.language_id = ?
                AND pd.title 
                    LIKE ?
                LIMIT $start, $perpage";

        $all = R::getAll($sql, [$lang['id'], "%$s%"]);

        return $all;
    }
}
