<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use Exception;
use wfm\App;
use wfm\Pagination;

/** @property \app\models\User $model */

class UserController extends AppController
{
    public function signupAction()
    {
        if (User::checkAuth()) {
            redirect(base_url());
        }

        if (!empty($_POST)) {
            $data = $_POST;
            $this->model->load($data);
            if (false === $this->model->validate($data) || !$this->model->checkUnique()) {
                $this->model->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $pass = $this->model->attributes['password'];
                $this->model->attributes['password'] = password_hash($pass, PASSWORD_DEFAULT);
                if ($this->model->save('user')) {
                    $_SESSION['success'] = ___('user_signup_success_register');
                } else {
                    $_SESSION['errors'] = ___('user_signup_error_register');
                }
            }
            redirect();
        }

        $this->setMeta(___('tpl_signup'));
    }

    public function loginAction()
    {
        if (User::checkAuth()) {
            redirect(base_url());
        }

        if (!empty($_POST)) {
            if ($this->model->login()) {
                $_SESSION['success'] = ___('user_login_success_login');
                redirect(base_url());
            } else {
                $_SESSION['errors'] = ___('user_login_error_login');
                redirect();
            }
        }
        $this->setMeta(___('tpl_login'));
    }

    public function logoutAction()
    {
        if (User::checkAuth()) {
            unset($_SESSION['user']);
        }
        redirect(base_url() . 'user/login');
    }

    public function cabinetAction()
    {
        if (!User::checkAuth()) {
            redirect(base_url() . 'user/login');
        }
        $this->setMeta(___('tpl_cabinet'));
    }

    public function ordersAction()
    {
        if (!User::checkAuth()) {
            redirect(base_url() . '/user/login');
        }

        $user_id = (int)$_SESSION['user']['id'];
        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        // $perpage = 1;
        $total = $this->model->get_count_orders($user_id);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $orders = $this->model->get_user_orders($start, $perpage, $user_id);

        $this->setMeta(___('user_orders_title'));
        $this->set(compact('orders', 'pagination', 'total'));
    }

    public function orderAction()
    {
        if (!User::checkAuth()) {
            redirect(base_url() . '/user/login');
        }

        $id = get('id');
        $order = $this->model->get_user_order($id);
        if (empty($order)) {
            throw new Exception("Order \"$id\" is not found", 404);
        }

        $this->setMeta(___('user_order_title'));
        $this->set(compact('order'));
    }

    public function filesAction()
    {
        if (!User::checkAuth()) {
            redirect(base_url() . '/user/login');
        }

        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        // $perpage = 1;
        $total = $this->model->get_count_files();
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $files = $this->model->get_user_files($start, $perpage, $lang);

        $this->setMeta(___('user_files_title'));
        $this->set(compact('files', 'pagination', 'total'));
    }
}
