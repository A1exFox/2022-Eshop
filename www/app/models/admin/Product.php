<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Product extends AppModel
{
    public function get_products(array $lang, int $start, int $perpage): array
    {
        $sql = "SELECT p.*, pd.title
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE pd.language_id = ?
                LIMIT $start,$perpage";

        $query = R::getAll($sql, [$lang['id']]);

        return $query;
    }
}
