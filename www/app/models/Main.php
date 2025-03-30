<?php

declare(strict_types=1);

namespace app\models;

use wfm\Model;
use RedBeanPHP\R;

class Main extends Model
{
    public function getNames(): array
    {
        return R::findAll('name');
    }
}
