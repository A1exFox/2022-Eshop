<?php

declare(strict_types=1);

namespace app\controllers\admin;

use wfm\App;
use RedBeanPHP\R;
use wfm\Pagination;

/** @property \app\models\admin\Page $model */
class PageController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 10;
        $total = R::count('page');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $pages = $this->model->get_pages($lang, $start, $perpage);

        $title = 'Список страниц';
        $this->setMeta("Админка::$title");
        $this->set(compact('title', 'pages', 'pagination', 'total'));
    }

    public function deleteAction()
    {
        $id = get('id');
        if ($this->model->deletePage($id)) {
            $_SESSION['success'] = 'Страница удалена';
        } else {
            $_SESSION['errors'] = 'Ошибка удаления страницы';
        }
        redirect();
    }
}
