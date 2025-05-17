<?php

declare(strict_types=1);

namespace wfm;

use RedBeanPHP\R;
use Valitron\Validator;

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

    public function validate(array $data): bool
    {
        $lang = App::$app->getProperty('language')['code'];
        Validator::langDir(APP . '/languages/validator/lang');
        Validator::lang($lang);
        $validator = new Validator($data);
        $validator->rules($this->rules);
        $validator->labels($this->getLabels());
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getErrors(): void
    {
        $errors = '<ul>' . PHP_EOL;
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= sprintf('<li>%s</li>', $item) . PHP_EOL;
            }
        }
        $errors .= '</ul>';
        $_SESSION['errors'] = $errors;
    }

    public function getLabels(): array
    {
        $labels = [];
        foreach ($this->labels as $k => $v) {
            $labels[$k] = ___($v);
        }
        return $labels;
    }

    public function save(string $table): int|string
    {
        $tbl = R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            if ($value !== '') {
                $tbl->$name = $value;
            }
        }
        return R::store($tbl);
    }
}
