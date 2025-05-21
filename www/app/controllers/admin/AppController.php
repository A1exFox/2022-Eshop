<?php

declare(strict_types=1);

namespace app\controllers\admin;

use app\models\AppModel;
use app\widgets\language\Language;
use wfm\App;
use wfm\Controller;

class AppController extends Controller
{
    public string|false $layout = 'admin';

    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModel();
        $languages = Language::getLanguages();
        App::$app->setProperty('languages', $languages);
        App::$app->setProperty('language', Language::getLanguage($languages));
    }
}
