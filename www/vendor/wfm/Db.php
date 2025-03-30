<?php

declare(strict_types=1);

namespace wfm;

use Exception;
use RedBeanPHP\R;

class Db
{
    use TSingleton;

    private function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['password']);

        if (!R::testConnection()) {
            throw new Exception("No connection to DB", 500);
        }

        R::freeze(true);

        if (DEBUG === 1) {
            R::debug(true, 3);
            // R::fancyDebug();
        }
    }
}
