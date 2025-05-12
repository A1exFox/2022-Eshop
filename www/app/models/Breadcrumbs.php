<?php

declare(strict_types=1);

namespace app\models;

use wfm\App;

class Breadcrumbs extends AppModel
{
    public static function getBreadcrumbs(string $category_id, string $name = ''): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $catPropName = sprintf('categories_%s', $lang);
        $categories = App::$app->getProperty($catPropName);
        $breadcrumbs_array = self::getParts($categories, $category_id);

        $breadcrumbs = "<li class=\"breadcrumb-item\">"
            . "<a href=\"" . base_url() . "\">"
            . ___('tpl_home_breadcrumbs') . "</a></li>" . PHP_EOL;

        if (is_array($breadcrumbs_array)) {
            foreach ($breadcrumbs_array as $slug => $title) {
                $breadcrumbs .= "<li class=\"breadcrumb-item\">"
                    . "<a href=\"category/" . $slug . "\">" . $title . "</a>"
                    . "</li>" . PHP_EOL;
            }
        }

        $breadcrumbs .= "<li class=\"breadcrumb-item active\">" . $name . "</li>";
        return $breadcrumbs;
    }

    public static function getParts(array $cats, string $id): array|false
    {
        if (empty($id)) {
            return false;
        }
        $breadcrumbs = [];

        for ($i = 0; $i < count($cats); $i++) {
            if (!isset($cats[$id])) {
                break;
            }
            $breadcrumbs[$cats[$id]['slug']] = $cats[$id]['title'];
            $id = $cats[$id]['parent_id'];
        }
        $breadcrumbs = array_reverse($breadcrumbs, true);
        return $breadcrumbs;
    }
}
