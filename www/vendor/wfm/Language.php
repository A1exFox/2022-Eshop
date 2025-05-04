<?php

declare(strict_types=1);

namespace wfm;

class Language
{
    public static array $lang_data = [];
    public static array $lang_layout = [];
    public static array $lang_view = [];

    public static function load(string $code, array $view): void
    {
        $lang_layout = sprintf('%s/languages/%s.php', APP, $code);
        $lang_view = sprintf('%s/languages/%s/%s/%s.php', APP, $code, $view['controller'], $view['action']);
        if (is_file($lang_layout)) {
            self::$lang_layout = require_once $lang_layout;
        }
        if (is_file($lang_view)) {
            self::$lang_view = require_once $lang_view;
        }

        self::$lang_data = array_merge(self::$lang_layout, self::$lang_view);
    }

    public static function get(string $key): string
    {
        if (isset(self::$lang_data[$key])) {
            return self::$lang_data[$key];
        }
        return $key;
    }
}
