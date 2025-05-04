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

        $meta_title = ___('main_index_meta_title');
        $meta_description = ___('main_index_meta_description');
        $meta_keywords = ___('main_index_meta_keywords');

        $this->setMeta($meta_title, $meta_description, $meta_keywords);
    }
}
