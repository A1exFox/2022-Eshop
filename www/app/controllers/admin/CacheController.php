<?php

declare(strict_types=1);

namespace app\controllers\admin;

use wfm\App;
use wfm\Cache;

class CacheController extends AppController
{
    public function indexAction()
    {
        $title = 'Управление кэшем';
        $this->setMeta("Админка::$title");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $langs = App::$app->getProperty('languages');
        $cache_key = get('cache', 's');
        $cache = Cache::getInstance();
        if ($cache_key == "category") {
            foreach ($langs as $lang => $item) {
                $cache->delete("ishop_menu_$lang");
            }
        }
        if ($cache_key == 'page') {
            foreach (array_keys($langs) as $lang) {
                $cache->delete("ishop_page_menu_$lang");
            }
        }
        $_SESSION['success'] = "Выбранный кэш удален";
        redirect();
    }
}
