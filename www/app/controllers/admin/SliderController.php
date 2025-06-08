<?php

declare(strict_types=1);

namespace app\controllers\admin;

/** @property \app\models\admin\Slider $model */
class SliderController extends AppController
{
    public function indexAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->update_slider();
            $_SESSION['success'] = 'Слайдер обновлен';
            redirect();
        }

        $gallery = $this->model->get_slides();

        $title = "Управление слайдером";
        $this->setMeta("Админка::$title");
        $this->set(compact('title', 'gallery'));
    }
}
