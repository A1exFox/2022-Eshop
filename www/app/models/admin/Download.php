<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Download extends AppModel
{
    public function get_downloads(array $lang, int $start, $perpage): array
    {
        return R::getAll("SELECT d.*,dd.* 
            FROM download d
            JOIN download_description dd
                ON d.id = dd.download_id
            WHERE dd.language_id = ?
                LIMIT $start,$perpage", [$lang['id']]);
    }
}
