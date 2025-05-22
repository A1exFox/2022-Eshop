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

function base_url(): string
{
    $lang = \wfm\App::$app->getProperty('lang');
    if ($lang === null) {
        $lang = '';
    } else {
        $lang = "$lang/";
    }
    return sprintf('%s/%s', PATH, $lang);
}

function get(string $key, string $type = 'i'): mixed
{
    $param = $key;
    $$param = $_GET[$param] ?? '';
    if ($type === 'i') {
        return (int) $$param;
    } elseif ($type === 'f') {
        return (float) $$param;
    } else {
        return trim($$param);
    }
}

function post(string $key, string $type = 's'): mixed
{
    $param = $key;
    $$param = $_POST[$param] ?? '';
    if ($type === 'i') {
        return (int)$$param;
    } elseif ($type === 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

function __(string $key): void
{
    echo \wfm\Language::get($key);
}

function ___(string $key): string
{
    return \wfm\Language::get($key);
}


function get_cart_icon(string $id): string
{
    $icon = '<i class="fas fa-shopping-cart"></i>';

    if (empty($_SESSION['cart'])) {
        return $icon;
    }
    if (array_key_exists($id, $_SESSION['cart'])) {
        $icon = '<i class="fas fa-luggage-cart"></i>';
    }
    return $icon;
}

function get_field_value(string $name): string
{
    if (isset($_SESSION['form_data'][$name])) {
        $data = h($_SESSION['form_data'][$name]);
    } else {
        $data = '';
    }
    return $data;
}

function get_field_array_value($name,  $key, $index): string
{
    if (isset($_SESSION['form_data'][$name][$key][$index])) {
        $data = h($_SESSION['form_data'][$name][$key][$index]);
    } else {
        $data = '';
    }
    return $data;
}
