<?php

declare(strict_types=1);

namespace app\controllers\admin;

use RedBeanPHP\R;
use wfm\Pagination;

/**
 * @property \app\models\admin\User $model
 */
class UserController extends AppController
{
    public function indexAction()
    {
        $page = get('page');
        $perpage = 10;
        $total = R::count('user');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $users = $this->model->get_users($start, $perpage);
        $title = 'Список пользователей';
        $this->setMeta("Админка::$title");
        $this->set(compact('title', 'users', 'pagination', 'total'));
    }

    public function loginAdminAction()
    {
        if ($this->model::isAdmin()) {
            redirect(ADMIN);
        }

        $this->layout = 'login';

        if (!empty($_POST)) {
            if ($this->model->login(true)) {
                $_SESSION['success'] = "Вы успешно авторизованы";
            } else {
                $_SESSION['errors'] = "Логин/пароль введены неревно";
            }

            if ($this->model::isAdmin()) {
                redirect(ADMIN);
            } else {
                redirect();
            }
        }
    }

    public function logoutAction()
    {
        if ($this->model::isAdmin()) {
            unset($_SESSION['user']);
        }
        redirect(ADMIN . '/user/login-admin');
    }
}
