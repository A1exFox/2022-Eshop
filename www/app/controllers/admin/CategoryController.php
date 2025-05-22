<?php

declare(strict_types=1);

namespace app\controllers\admin;

class CategoryController extends AppController
{
    public function indexAction()
    {
        $title = 'Категории';
        $this->setMeta("Админка :: $title");
        $this->set(compact('title'));
    }
}
