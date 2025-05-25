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
}
