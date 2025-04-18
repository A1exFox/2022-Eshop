<?php

declare(strict_types=1);

namespace app\widgets\language;

use RedBeanPHP\R;

class Language
{
    protected $tpl;
    protected $languages;
    protected $language;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/lang_tpl.php';
        $this->run();
    }

    protected function run(): void {}

    public static function getLanguages(): array
    {
        return R::getAssoc("SELECT code, title, base, id
            FROM language
            ORDER BY base
            DESC");
    }

    public static function getLanguage($language) {}
}
