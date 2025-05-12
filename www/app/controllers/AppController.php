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

        $sql = "SELECT c.*, cd.*
            FROM category c
            JOIN category_description cd
            ON c.id = cd.category_id
            WHERE cd.language_id = ?";

        $categories = \RedBeanPHP\R::getAssoc($sql, [$language['id']]);
        App::$app->setProperty(sprintf('categories_%s', $language['code']), $categories);
    }
}
