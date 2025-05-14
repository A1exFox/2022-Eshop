<?php

declare(strict_types=1);

namespace app\controllers;

use wfm\App;
use wfm\Pagination;
use app\models\Breadcrumbs;

/** @property \app\models\Category $model */

class CategoryController extends AppController
{
    public function viewAction(): void
    {
        $lang  = App::$app->getProperty('language');
        $category = $this->model->get_category($this->route['slug'], $lang);

        if (is_null($category) || empty($category)) {
            $this->error_404();
            return;
        }
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);
        $ids = $this->model->getIds($category['id']) . $category['id'];

        $page = abs(get('page')) ?: 1;
        $perpage = App::$app->getProperty('pagination');
        $total = $this->model->get_count_products($ids);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_products($ids, $lang, $start, $perpage);

        $this->setMeta($category['title'], (string)$category['description'], (string)$category['keywords']);
        $this->set(compact('products', 'category', 'breadcrumbs', 'total', 'pagination'));
    }
}
