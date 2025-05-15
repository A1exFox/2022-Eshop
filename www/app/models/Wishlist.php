<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;

class Wishlist extends AppModel
{
    public function get_product(int $id): array|null|string
    {
        $sql = "SELECT id
            FROM product
            WHERE status = 1
                AND id = ?";

        $cell = R::getCell($sql, [$id]);

        return $cell;
    }

    public function add_to_wishlist(int $id): void
    {
        $wishlist = self::get_wishlist_ids();
        if (empty($wishlist)) {
            setcookie('wishlist', (string) $id, time() + 3600 * 24 * 7 * 30, '/');
        } else {
            if (!in_array($id, $wishlist)) {
                if (count($wishlist) > 5) {
                    array_shift($wishlist);
                }
                $wishlist[] = $id;
                $wishlist = implode(',', $wishlist);
                setcookie('wishlist', $wishlist, time() + 3600 * 24 * 7 * 30, '/');
            }
        }
    }

    public static function get_wishlist_ids(): array
    {
        $wishlist = $_COOKIE['wishlist'] ?? '';
        if ($wishlist) {
            $wishlist = explode(',', $wishlist);
        }
        if (is_array($wishlist)) {
            $wishlist = array_slice($wishlist, 0, 6);
            $wishlist = array_map('intval', $wishlist);
            return $wishlist;
        }
        return [];
    }
}
