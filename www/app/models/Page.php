<?php

declare(strict_types=1);

namespace app\models;

class Page extends AppModel
{
    public function get_page(string $slug, array $lang): ?array
    {
        $sql = "SELECT p.*, pd.*
            FROM page p
            JOIN page_description pd
                ON p.id = pd.page_id
            WHERE p.slug = ? 
                AND pd.language_id = ?";

        $query = \RedBeanPHP\R::getRow($sql, [$slug, $lang['id']]);

        return $query;
    }
}
