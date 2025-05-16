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
            debug($data);
            debug($this->model->attributes);
        }

        $this->setMeta(___('tpl_signup'));
    }
}
