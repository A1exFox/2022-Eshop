<?php

declare(strict_types=1);

namespace wfm;

class Registry
{
    use TSingleton;

    protected static array $properties = [];

    public function setProperty(string $name, mixed $value): void
    {
        self::$properties[$name] = $value;
    }

    public function getProperty(string $name): mixed
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }
}
