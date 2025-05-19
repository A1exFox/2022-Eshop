<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;

class User extends AppModel
{
    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => '',
    ];

    public array $rules = [
        'required' => [
            ['email'],
            ['password'],
            ['name'],
            ['address'],
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['password', 6],
        ],
    ];

    public array $labels = [
        'email' => 'tpl_signup_email_input',
        'password' => 'tpl_signup_password_input',
        'name' => 'tpl_signup_name_input',
        'address' => 'tpl_signup_address_input',
    ];

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public function checkUnique(string $text_error = ''): bool
    {
        $user = R::findOne('user', 'email = ?', [$this->attributes['email']]);
        if ($user) {
            $this->errors['unique'][] = $text_error ?: ___('user_signup_error_email_unique');
            return false;
        }
        return true;
    }

    public function login(bool $is_admin = false)
    {
        $email = post('email');
        $password = post('password');
        if ($email && $password) {
            if ($is_admin) {
                $user = R::findOne('user', "email = ? AND role = 'admin'", [$email]);
            } else {
                $user = R::findOne('user', "email = ?", [$email]);
            }

            if ($user) {
                if (password_verify($password, $user->password)) {
                    foreach ($user as $k => $v) {
                        if ($k !== 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function get_count_orders(int $user_id): int
    {
        $count = R::count('orders', 'user_id = ?', [$user_id]);
        return $count;
    }

    public function get_user_orders(int $start, int $perpage, int $user_id): array
    {
        $sql = "SELECT *
            FROM orders
            WHERE user_id = ?
                ORDER BY id DESC
                LIMIT $start, $perpage";
        $query = R::getAll($sql, [$user_id]);
        return $query;
    }

    public function get_user_order(int $id): array
    {
        $sql = "SELECT o.*, op.*
            FROM orders o
            JOIN order_product op
                ON o.id = op.order_id
            WHERE o.id = ?";

        $all = R::getAll($sql, [$id]);

        return $all;
    }

    public function get_count_files(): int
    {
        $count = R::count('order_download', 'user_id = ? AND status = 1', [$_SESSION['user']['id']]);
        return $count;
    }

    public function get_user_files(int $start, int $perpage, array $lang): array
    {
        $sql = "SELECT od.*, d.*, dd.*
            FROM order_download od
            JOIN download d
                ON d.id = od.download_id
            JOIN download_description dd
                ON d.id = dd.download_id
            WHERE od.user_id = ?
                AND od.status = 1
                AND dd.language_id = ?
                LIMIT $start,$perpage";

        $all = R::getAll($sql, [$_SESSION['user']['id'], $lang['id']]);

        return $all;
    }
}
