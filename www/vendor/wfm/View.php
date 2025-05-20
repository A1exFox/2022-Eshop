<?php

declare(strict_types=1);

namespace wfm;

use Exception;

class View
{
    public string $content = '';

    public array $route;
    public string|false $layout;
    public string $view;
    public array $meta;

    public function __construct(
        array $route,
        string $layout = '',
        string $view = '',
        array $meta = []
    ) {
        $this->route = $route;
        $this->layout = $layout;
        $this->view = $view;
        $this->meta = $meta;

        if ($this->layout !== false) {
            if ($this->layout === '') {
                $this->layout = LAYOUT;
            }
        }
    }

    public function render(array $data): void
    {
        extract($data);
        $prefix = str_replace("\\", '/', $this->route['admin_prefix']);

        $viewFile = APP . "/views/$prefix" .
            $this->route['controller'] . '/' .
            $this->view . '.php';

        if (!is_file($viewFile)) {
            throw new Exception("View file $viewFile is not found", 404);
        }

        ob_start();
        require_once $viewFile;
        $this->content = ob_get_clean();

        if (false !== $this->layout) {
            $layoutFile = APP . '/views/layouts/' . $this->layout . '.php';
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new Exception("Layout $layoutFile is not found", 404);
            }
        }
    }
}
