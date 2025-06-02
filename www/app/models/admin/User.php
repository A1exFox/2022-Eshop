<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;

class User extends \app\models\User
{
    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
    }

    public function get_users($start, $perpage): array
    {
        return R::findAll('user', "LIMIT $start,$perpage");
    }
}
