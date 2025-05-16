<?php

declare(strict_types=1);

namespace app\widgets\page;

class Page
{
    protected array $language;
    protected string $container = 'ul';
    protected string $class = 'page-menu';
    protected int $cache = 3600;
    protected string $cachekey = 'ishop_page_menu';
    protected string $menuPageHtml = '';
    protected string $prepend = '';

    public function __construct($options = [])
    {
        $this->language = \wfm\App::$app->getProperty('language');
        $this->getOptions($options);

        $cache = \wfm\Cache::getInstance();
        $cachekey = sprintf("%s_%s", $this->cachekey, $this->language['code']);
        $html = $cache->get($cachekey);
        if (!is_string($html) || empty($html)) {
            $sql = "SELECT p.*, pd.*
                FROM page p
                JOIN page_description pd
                    ON p.id = pd.page_id
                WHERE pd.language_id = ?";

            $query = \RedBeanPHP\R::getAssoc($sql, [$this->language['id']]);
            $html = $this->getMenuPageHtml($query);

            if ($this->cache > 0) {
                $cache->set($cachekey, $html, $this->cache);
            }
        }
        $this->menuPageHtml = $html;
        $this->output();
    }

    protected function getMenuPageHtml(array $list): string
    {
        $html = '';
        foreach ($list as $item) {
            $html .= sprintf(
                '<li><a href="page/%s">%s</a></li>',
                $item['slug'],
                $item['title']
            ) . PHP_EOL;
        }
        return $html;
    }

    protected function getOptions(array $options): void
    {
        foreach ($options as $key => $option) {
            if (property_exists($this, $key)) {
                $this->$key = $option;
            }
        }
    }

    protected function output(): void
    {
        $html = sprintf('<%s class="%s">', $this->container, $this->class) . PHP_EOL;
        $html .= sprintf('%s', $this->prepend) . PHP_EOL;
        $html .= sprintf('%s', $this->menuPageHtml);
        $html .= sprintf('</$s>', $this->container) . PHP_EOL;
        echo $html;
    }
}
