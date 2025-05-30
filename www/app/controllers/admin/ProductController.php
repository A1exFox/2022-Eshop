<?php

declare(strict_types=1);

namespace app\controllers\admin;

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
        $perpage = 10;
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
                $_SESSION['success'] = "Товар добавлен";
            }
            debug($_POST, true);
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
}
