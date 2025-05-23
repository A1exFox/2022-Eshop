<?php

declare(strict_types=1);

namespace app\models\admin;

class User extends \app\models\User
{
    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
    }
}
