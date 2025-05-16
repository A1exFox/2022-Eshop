<?php

declare(strict_types=1);

namespace app\controllers;

/** @property \app\models\Page $model */

class PageController extends AppController
{
    public function viewAction()
    {
        $lang = \wfm\App::$app->getProperty('language');
        $page = $this->model->get_page($this->route['slug'], $lang);
        if (is_null($page) || empty($page)) {
            $this->error_404();
            return;
        }

        $this->setMeta($page['title'], (string) $page['description'], (string) $page['keywords']);
        $this->set(compact('page'));
    }
}
