<?php

declare(strict_types=1);

namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');
        $names = ['John', 'Dave', 'Katy'];
        $this->set(compact('names'));
    }
}
