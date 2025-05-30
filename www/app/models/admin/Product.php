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

    public function product_validate(): bool
    {
        $errors = '';
        if (!is_numeric($_POST['price'])) {
            $errors .= "Цена должна иметь числовое значение<br>";
        }
        if (!is_numeric($_POST['old_price'])) {
            $errors .= "Старая цена должна иметь числовое значение<br>";
        }

        foreach ($_POST['product_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            $item['exerpt'] = trim($item['exerpt']);
            if (empty($item['title'])) {
                $errors .= "Наименование не заполненео на вкладке $lang_id<br>";
            }
            if (empty($item['exerpt'])) {
                $errors .= "Краткое описание не заполнено на вкладке $lang_id<br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = false;
            return false;
        }
        return true;
    }
}
