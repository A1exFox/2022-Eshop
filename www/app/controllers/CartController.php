<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Order;
use app\models\User;
use wfm\App;

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

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = get('id');
        if (isset($_SESSION['cart'][$id])) {
            $this->model->delete_item($id);
        }
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }

        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);

        $this->loadView('cart_modal');
        return true;
    }

    public function viewAction()
    {
        $this->setMeta(___('tpl_cart_title'));
    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            if (!\app\models\User::checkAuth()) {
                $user = new \app\models\User();
                $data = $_POST;
                $user->load($data);
                if (!$user->validate($data) || !$user->checkUnique(___('cart_checkout_error_email_unique'))) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $data;
                    redirect();
                } else {
                    $user->attributes['password'] = password_hash(
                        $user->attributes['password'],
                        PASSWORD_DEFAULT
                    );
                    if (!$user_id = $user->save('user')) {
                        $_SESSION['errors'] = ___('cart_checkout_error_register');
                        redirect();
                    }
                }
            }

            $data['user_id'] = $user_id ?? $_SESSION['user']['id'];
            $data['note'] = post('note');
            $user_email = $_SESSION['user']['email'] ?? post('email');

            if (!$order_id = Order::saveOrder($data)) {
                $_SESSION['errors'] = ___('cart_checkout_error_save_order');
            } else {
                Order::mailOrder($order_id, $user_email, 'mail_order_user');

                $admin_email = App::$app->getProperty('admin_email');
                Order::mailOrder($order_id, $admin_email, 'mail_order_admin');

                unset($_SESSION['cart']);
                unset($_SESSION['cart.sum']);
                unset($_SESSION['cart.qty']);

                $_SESSION['success'] = ___('cart_checkout_order_success');
            }
        }
        redirect();
    }
}
