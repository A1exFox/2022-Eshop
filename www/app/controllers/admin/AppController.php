<?php

declare(strict_types=1);

namespace app\controllers\admin;

use app\models\admin\User;
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

        if (!User::isAdmin() && $route['action'] != 'login-admin') {
            redirect(ADMIN . '/user/login-admin');
        }

        new AppModel();
        $languages = Language::getLanguages();
        App::$app->setProperty('languages', $languages);
        App::$app->setProperty('language', Language::getLanguage($languages));
    }
}
