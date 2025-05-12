<?php

declare(strict_types=1);

namespace app\widgets\menu;

class Menu
{
    protected array $data;
    protected array $tree;
    protected string $menuHtml;
    protected string $tpl;
    protected string $container = 'ul';
    protected string $class = 'menu';
    protected string $table = 'category';
    protected int $cache = 3600;
    protected string $cacheKey = 'ishop_menu';
    protected array $attrs = [];
    protected string $prepend = '';
    protected array $language;

    public function __construct(array $options = [])
    {
        $this->language = \wfm\App::$app->getProperty('language');
        $this->tpl = __DIR__ . '/menu_tpl.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions(array $options): void
    {
        foreach ($options as $option => $value) {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }
    }

    protected function run(): void
    {
        $cache_name = sprintf('%s_%s', $this->cacheKey, $this->language['code']);
        $cache = \wfm\Cache::getInstance()->get($cache_name);
        if ($cache) {
            $this->menuHtml = $cache;
            $this->output();
            return;
        }

        $this->data = \wfm\App::$app->getProperty(sprintf('categories_%s', $this->language['code']));
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        if ($this->cache > 0) {
            \wfm\Cache::getInstance()->set($cache_name, $this->menuHtml, $this->cache);
        }

        $this->output();
    }

    protected function output()
    {
        $attrs = '';
        foreach ($this->attrs as $k => $v) {
            $attrs .= " $k='$v' ";
        }
        echo sprintf('<%s class="%s" %s>', $this->container, $this->class, $attrs);
        echo $this->prepend;
        echo $this->menuHtml;
        echo sprintf('</%s>', $this->container);
    }

    protected function getTree(): array
    {
        $data = $this->data;
        $tree = [];
        foreach ($data as $id => &$node) {
            $parent_id = (int)$node['parent_id'];
            if ($parent_id === 0) {
                $tree[$id] = &$node;
                continue;
            }
            $data[$parent_id]['children'][$id] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml(array $tree, string $tab = ''): string
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate(array $category, string $tab, mixed $id): string
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
