<?php

declare(strict_types=1);

namespace wfm;

trait TSingleton
{
    private static self|null $instance = null;
    private function __construct() {}
    public static function getInstance(): static
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
