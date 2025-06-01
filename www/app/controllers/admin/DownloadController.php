<?php

declare(strict_types=1);

namespace app\controllers\admin;

use wfm\App;
use RedBeanPHP\R;
use wfm\Pagination;

/**
 * @property \app\models\admin\Download $model
 */

class DownloadController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 20;
        $total = R::count('download');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $downloads = $this->model->get_downloads($lang, $start, $perpage);
        $title = "Файлы(цифровые товары)";
        $this->setMeta("Админка::$title");
        $this->set(compact('title', 'downloads', 'pagination', 'total'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->download_validate()) {
                if ($data = $this->model->upload_file()) {
                    if ($this->model->save_download($data)) {
                        $_SESSION['success'] = "Файл добавлен";
                    } else {
                        $_SESSION['errors'] = "Ошибка добавления файла";
                    }
                } else {
                    $_SESSION['errors'] = "Ошибка перемещения файла";
                }
            }
            redirect();
        }
        $title = "Добавление файла(цифровые товары)";
        $this->setMeta("Админка::$title");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $id = get('id');
        if (R::count('order_download', 'download_id = ?', [$id])) {
            $_SESSION['errors'] = "Нельзя удалить приобретенный файл";
            redirect();
        }
        // if (R::count('product_download', 'download_id = ?', [$id])) {
        //     $_SESSION['errors'] = "Нельзя удалить прикрепленный к товару файл";
        //     redirect();
        // }
        if ($this->model->download_delete($id)) {
            $_SESSION['success'] = 'Файл удален';
        } else {
            $_SESSION['errors'] = 'Ошибка удаления файла';
        }
        redirect();
    }
}
