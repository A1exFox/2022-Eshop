<?php

declare(strict_types=1);

if (PHP_MAJOR_VERSION < 8) {
    die("You have to use php version more than 8.0.0");
}

require_once dirname(__DIR__) . "/config/init.php";
require_once HELPERS . "/functions.php";
require_once CONFIG . "/routes.php";

new \wfm\App();
