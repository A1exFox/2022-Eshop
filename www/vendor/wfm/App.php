<?php

declare(strict_types=1);

namespace wfm;

class App
{
    public static Registry $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        session_start();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch($query);
    }

    protected function getParams(): void
    {
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }

        if (is_file(CONFIG . '/smtp.php')) {
            $smtp = require_once CONFIG . '/smtp.php';
        } else {
            $smtp = [];
        }

        foreach ($smtp as $k => $v) {
            self::$app->setProperty($k, $v);
        }
    }
}
