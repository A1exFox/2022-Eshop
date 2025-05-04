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

        $languages = Language::getLanguages();
        $language = Language::getLanguage($languages);

        App::$app->setProperty('languages', $languages);
        App::$app->setProperty('language', $language);

        \wfm\Language::load($language['code'], $this->route);
    }
}
