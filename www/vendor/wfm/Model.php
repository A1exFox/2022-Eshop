<?php

declare(strict_types=1);

namespace wfm;

abstract class Model
{
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];
    public array $labels = [];

    public function __construct()
    {
        Db::getInstance();
    }

    public function load(array $data)
    {
        foreach (array_keys($this->attributes) as $name) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }
}
