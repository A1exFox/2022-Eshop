<?php

declare(strict_types=1);

namespace app\controllers\admin;

use Exception;
use wfm\App;
use wfm\Pagination;

/**
 * @property \app\models\admin\Product $model
 */

class ProductController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 5;
        $total = \RedBeanPHP\R::count('product');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $products = $this->model->get_products($lang, $start, $perpage);

        $title = 'Список товаров';
        $this->setMeta("Админка::$title");
        $this->set(compact('title', 'products', 'pagination', 'total'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->product_validate()) {
                if ($this->model->save_product()) {
                    $_SESSION['success'] = "Товар добавлен";
                } else {
                    $_SESSION['errors'] = "Ошибка добавления товара";
                }
            }
            redirect();
        }
        $title = 'Новый товар';
        $this->setMeta("Админка::$title");
        $this->set(compact('title'));
    }

    public function getDownloadAction()
    {
        $q = get('q', 's');
        $downloads = $this->model->get_downloads($q);
        echo json_encode($downloads);
        die;
    }

    public function editAction()
    {
        $id = get('id');

        if (!empty($_POST)) {
            if ($this->model->product_validate()) {
                if ($this->model->update_product($id)) {
                    $_SESSION['success'] = "Товар сохранен";
                } else {
                    $_SESSION['errors'] = "Ошибка добавления товара";
                }
            }
            redirect();
        }

        $product = $this->model->get_product($id);
        if (!$product) {
            throw new Exception("Not found product", 404);
        }
        $gallery = $this->model->get_gallery($id);
        $lang = App::$app->getProperty('language')['id'];
        App::$app->setProperty('parent_id', $product[$lang]['category_id']);

        $title = "Редактирование товара";
        $this->setMeta("Админка::$title");
        $this->set(compact('title', 'product', 'gallery'));
    }
}
