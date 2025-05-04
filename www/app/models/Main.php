<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;

class Main extends AppModel
{
    public function get_hits(array $lang, int $limit): array
    {
        return R::getAll("SELECT p.*, pd.* 
            FROM product p
                JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.status = 1
                AND p.hit = 1
                AND pd.language_id = ?
            LIMIT $limit", [$lang['id']]);
    }
}
