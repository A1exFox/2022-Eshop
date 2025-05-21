<?php

declare(strict_types=1);

namespace app\controllers\admin;

class MainController extends AppController
{
    public function indexAction()
    {
        $title = 'Главная страница';
        $this->setMeta('Админка :: Главная страница');
        $this->set(compact('title'));
    }
}
