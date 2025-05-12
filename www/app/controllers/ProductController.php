<?php

declare(strict_types=1);

namespace app\controllers;

use Exception;
use wfm\App;

/** @property \app\models\Product $model */

class ProductController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $product = $this->model->get_product($this->route['slug'], $lang);

        if (is_null($product) || empty($product)) {
            throw new Exception(sprintf("Товар по запросу \"%s\" не найден", $this->route['slug']));
        }

        $gallery = $this->model->get_gallery($product['id']);

        $this->setMeta((string)$product['title'], (string)$product['description'], (string)$product['keywords']);
        $this->set(compact(['product', 'gallery']));
    }
}
