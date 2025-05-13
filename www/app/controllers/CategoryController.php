<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Breadcrumbs;
use wfm\App;

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
        $products = $this->model->get_products($ids, $lang);

        $this->setMeta($category['title'], (string)$category['description'], (string)$category['keywords']);
        $this->set(compact('products', 'category', 'breadcrumbs'));
    }
}
