<?php

declare(strict_types=1);
define("DEBUG", 0);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/wfm");
define("HELPERS", ROOT . "/vendor/wfm/helpers");
define("CACHE", ROOT . "/tmp/cache");
define("LOGS", ROOT . "/tmp/logs");
define("CONFIG", ROOT . "/config");
define("LAYOUT", 'ishop');
define("PATH", 'http://localhost');
define("ADMIN", 'http://localhost/admin');
define("NO_IMAGE", 'uploads/no-image.jpg');

require_once ROOT . "/vendor/autoload.php";
