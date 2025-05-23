<?php

declare(strict_types=1);

namespace app\controllers\admin;

use RedBeanPHP\R;

/** @property \app\models\admin\Category $model */

class CategoryController extends AppController
{
    public function indexAction()
    {
        $title = 'Категории';
        $this->setMeta("Админка :: $title");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $id = get('id');
        $errors = '';
        $children = R::count('category', 'parent_id = ?', [$id]);
        $products = R::count('product', 'category_id = ?', [$id]);
        if ($children) {
            $errors .= 'Ошибка! Категория содержит вложенные категории<br>';
        }
        if ($products) {
            $errors .= 'Ошибка! Категория содержит товары<br>';
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            redirect();
        }
        R::exec("DELETE FROM category WHERE id = ?", [$id]);
        R::exec("DELETE FROM category_description WHERE category_id = ?", [$id]);
        $_SESSION['success'] = 'Категория удалена';
        redirect();
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->category_validate()) {
                if ($this->model->save_category()) {
                    $_SESSION['success'] = "Категория сохранена";
                } else {
                    $_SESSION['errors'] = 'Ошибка сохранения категории';
                }
            }
            redirect();
        }
        $title = 'Добавление категорий';
        $this->setMeta("Админка :: $title");
        $this->set(compact('title'));
    }
}
