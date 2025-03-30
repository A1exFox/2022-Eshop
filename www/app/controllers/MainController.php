<?php

declare(strict_types=1);

namespace app\controllers;

use wfm\Controller;
use app\models\Main;

/** @property Main $model */

class MainController extends Controller
{
    public function indexAction()
    {
        $names = $this->model->getNames();
        // $names = $this->model->getNames();
        $this->setMeta('Главная страница', 'Description...', 'keywords...');
        $this->set(compact('names'));
    }
}
