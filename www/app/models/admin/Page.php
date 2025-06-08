<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Page extends AppModel
{
    public function get_pages($lang, $start, $perpage): array
    {
        return R::getAll("SELECT p.*, pd.title 
            FROM page p
            JOIN page_description pd
                ON p.id = pd.page_id
            WHERE pd.language_id = ?
                LIMIT $start, $perpage", [$lang['id']]);
    }

    public function deletePage($id): bool
    {
        R::begin();
        try {
            $page = R::load('page', $id);
            if (!$page) {
                R::rollback();
                return false;
            }
            R::trash($page);
            R::exec("DELETE FROM page_description
                WHERE page_id = ?", [$id]);

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }
}
