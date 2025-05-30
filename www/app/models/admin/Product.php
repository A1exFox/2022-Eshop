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

    public function get_downloads(string $q): array
    {
        $data = [];
        $downloads = R::getAssoc(
            "SELECT download_id, name
            FROM download_description
            WHERE name 
                LIKE ? 
                LIMIT 10",
            ["%$q%"]
        );

        if ($downloads) {
            $i = 0;
            foreach ($downloads as $id => $title) {
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        return $data;
    }
}
