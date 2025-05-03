<?php

declare(strict_types=1);

function debug(mixed $data, bool $die = false): void
{
    echo "<pre>";
    echo print_r($data, true);
    echo "</pre>";
    if ($die == true) {
        die;
    }
}

function h(string $str): string
{
    $str = htmlspecialchars($str);
    return $str;
}

function redirect(string $http = ''): void
{
    if ($http !== '') {
        header("Location: $http");
        die;
    }

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }

    header("Location: " . PATH);
    die;
}
