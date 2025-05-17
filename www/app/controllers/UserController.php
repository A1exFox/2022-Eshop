<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;

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
            if (false === $this->model->validate($data)) {
                $this->model->getErrors();
            } else {
                $_SESSION['success'] = ___('user_signup_success_register');
            }
            redirect();
        }

        $this->setMeta(___('tpl_signup'));
    }
}
