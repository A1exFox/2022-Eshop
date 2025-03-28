<?php

declare(strict_types=1);

namespace wfm;

abstract class Controller
{
    public array $route = [];
    public array $data = [];
    public array $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    public string|false $layout = '';
    public string|false $view = '';
    public object $model;

    public function __construct(array $route)
    {
        $this->route = $route;
    }

    public function getModel(): void
    {
        $model = 'app\models\\' .
            $this->route['admin_prefix'] .
            $this->route['controller'];

        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    public function getView(): void
    {
        if ($this->view === '') {
            $this->view = $this->route['action'];
        }
        $view = new View($this->route, $this->layout, $this->view, $this->meta);
        $view->render($this->data);
    }

    public function set(array $data): void
    {
        $this->data = $data;
    }

    public function setMeta(
        string $title = '',
        string $description = '',
        string $keywords = ''
    ): void {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}
