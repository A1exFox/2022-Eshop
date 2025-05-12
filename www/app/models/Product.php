<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;

class Product extends AppModel
{
    public function get_product(string $slug, array $lang): ?array
    {
        $sql = "SELECT p.*,pd.*
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.status = 1
                AND p.slug = ?
                AND pd.language_id = ?
        ";

        $query = R::getRow($sql, [$slug, $lang['id']]);

        return $query;
    }

    public function get_gallery(string $product_id): array
    {
        $sql = "SELECT *
            FROM product_gallery
            WHERE product_id = ?";

        $query = R::getAll($sql, [$product_id]);
        return $query;
    }
}
