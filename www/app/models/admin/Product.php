<?php

declare(strict_types=1);

namespace app\models\admin;

use wfm\App;
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

    public function save_product(): bool
    {
        $lang = (int)App::$app->getProperty('language')['id'];
        R::begin();
        try {
            $product = R::dispense('product');
            $product->category_id = post('parent_id', 'i');
            $product->price = post('price', 'f');
            $product->old_price = post('old_price', 'f');
            $product->status = post('status') ? 1 : 0;
            $product->hit = post('hit') ? 1 : 0;
            $product->img = post('img') ? ltrim(post('img'), '/') : NO_IMAGE;
            $product->is_download = post('is_download') ? 1 : 0;

            $product_id = R::store($product);
            $product->slug = AppModel::create_slug('product', 'slug', $_POST['product_description'][$lang]['title'], (int)$product_id);
            R::store($product);

            foreach ($_POST['product_description'] as $lang_id => $item) {
                $fields = 'product_id, language_id, title, content, exerpt, keywords, description';
                $values = '?,?,?,?,?,?,?';
                $data = [
                    $product_id,
                    $lang_id,
                    $item['title'],
                    $item['content'],
                    $item['exerpt'],
                    $item['keywords'],
                    $item['description'],
                ];
                R::exec(
                    "INSERT INTO product_description ($fields)
                    VALUES ($values)",
                    $data
                );
            }

            if (isset($_POST['gallery']) && is_array($_POST['gallery'])) {
                $sql = "INSERT INTO product_gallery (product_id, img) VALUES ";
                foreach ($_POST['gallery'] as $item) {
                    $sql .= "($product_id, ?),";
                }
                $sql = rtrim($sql, ',');
                R::exec($sql, $_POST['gallery']);
            }

            if ($product->is_download) {
                $download_id = post('is_download', 'i');
                R::exec(
                    "INSERT INTO product_download (product_id,download_id)
                    VALUES (?,?)",
                    [$product_id, $download_id],
                );
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            $_SESSION['form-data'] = $_POST;
            return false;
        }
    }
}
