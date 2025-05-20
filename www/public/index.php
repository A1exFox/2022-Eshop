<?php

declare(strict_types=1);

if (PHP_MAJOR_VERSION < 8) {
    die("You have to use php version more than 8.0.0");
}

require_once dirname(__DIR__) . "/config/init.php";

new \wfm\App();


// echo $test;
// throw new Exception("Ошибочка", 500);
