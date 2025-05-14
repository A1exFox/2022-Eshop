<?php

declare(strict_types=1);

namespace app\controllers;

use wfm\App;

/** @property \app\models\Search $model */

class SearchController extends AppController
{
    public function indexAction()
    {
        $s = get('s', 's');
        $lang = App::$app->getProperty('language');

        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        $total = $this->model->get_count_find_product($s, $lang);

        $pagination = new \wfm\Pagination($page, $perpage, $total);

        $start = $pagination->getStart();
        $products = $this->model->get_find_products($s, $lang, $start, $perpage);

        $this->setMeta(___('search_index_title'));
        $this->set(compact('s', 'products', 'pagination', 'total'));
    }
}
