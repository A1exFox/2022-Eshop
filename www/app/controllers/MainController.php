<?php

declare(strict_types=1);

namespace app\controllers;

use RedBeanPHP\R;
use app\models\Main;

/** @property Main $model */

class MainController extends AppController
{
    public function indexAction()
    {
        $slides = R::findAll('slider');

        $this->set(compact(['slides']));
    }
}
