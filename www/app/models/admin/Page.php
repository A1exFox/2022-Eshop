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

    public function page_validate(): bool
    {
        $errors = '';

        foreach ($_POST['page_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            $item['content'] = trim($item['content']);
            if (empty($item['title'])) {
                $errors .= "Наименование не заполненео на вкладке $lang_id<br>";
            }
            if (empty($item['content'])) {
                $errors .= "Oписание не заполнено на вкладке $lang_id<br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function save_page(): bool
    {
        $lang = (int)\wfm\App::$app->getProperty('language')['id'];
        R::begin();
        try {
            $page = R::dispense('page');
            $page_id = R::store($page);
            $page->slug = AppModel::create_slug('page', 'slug', $_POST['page_description'][$lang]['title'], (int)$page_id);
            R::store($page);

            foreach ($_POST['page_description'] as $lang_id => $item) {
                $fields = 'page_id, language_id, title, content, keywords, description';
                $values = '?,?,?,?,?,?';
                $data = [
                    $page_id,
                    $lang_id,
                    $item['title'],
                    $item['content'],
                    $item['keywords'],
                    $item['description'],
                ];
                R::exec(
                    "INSERT INTO page_description ($fields)
                    VALUES ($values)",
                    $data
                );
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }
}
