<?php

declare(strict_types=1);

namespace app\controllers;

use wfm\Controller;
use app\models\AppModel;
use app\widgets\language\Language;
use wfm\App;

class AppController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty('languages', Language::getLanguages());
        debug(App::$app->getProperty('languages'), true);
    }
}
