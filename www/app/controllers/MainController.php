<?php

declare(strict_types=1);

namespace app\controllers;

use RedBeanPHP\R;
use app\models\Main;
use wfm\App;

/** @property Main $model */

class MainController extends AppController
{
    public function indexAction()
    {
        $slides = R::findAll('slider');
        $lang = App::$app->getProperty('language');
        $products = $this->model->get_hits($lang, 6);


        $this->set(compact(['slides', 'products']));
        $this->setMeta("Main page", 'description', 'keywords');
    }
}
