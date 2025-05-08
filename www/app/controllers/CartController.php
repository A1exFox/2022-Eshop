<?php

declare(strict_types=1);

namespace app\controllers;

/** @property \app\models\Cart $model */

class CartController extends AppController
{
    public function addAction()
    {
        $lang = \wfm\App::$app->getProperty('language');
        $id = get('id');
        $qty = get('qty');

        if (!$id) {
            return false;
        }

        $product = $this->model->get_product($id, $lang);

        if (is_null($product) || count($product) === 0) {
            return false;
        }

        $this->model->add_to_cart($product, $qty);

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }
}
