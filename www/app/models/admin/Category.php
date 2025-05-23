<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Category extends AppModel
{
    public function category_validate(): bool
    {
        $errors = '';
        foreach ($_POST['category_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            if (empty($item['title'])) {
                $errors .= "Не заполнено наименование во вкладке $lang_id<br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function save_category(): bool
    {
        R::begin();
        try {
            $category = R::dispense('category');
            $category->parent_id = post('parent_id', 'i');
            $category_id = R::store($category);
            $category->slug = AppModel::create_slug('category', 'slug', $_POST['category_description'][1]['title'], (int)$category_id);
            R::store($category);

            foreach ($_POST['category_description'] as $lang_id => $item) {
                $fields = 'category_id, language_id, title, description, keywords, content';
                $values = '?,?,?,?,?,?';
                $data = [
                    $category_id,
                    $lang_id,
                    $item['title'],
                    $item['description'],
                    $item['keywords'],
                    $item['content'],
                ];
                R::exec(
                    "INSERT INTO category_description ($fields)
                    VALUES ($values)",
                    [$data]
                );
            }
            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }
}
