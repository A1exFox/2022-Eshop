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

    public function get_wishlist_products(array $lang): array
    {
        $wishlist = self::get_wishlist_ids();
        if (count($wishlist) > 0) {
            $wishlist = implode(',', $wishlist);
            $sql = "SELECT p.*, pd.*
                FROM product p
                JOIN product_description pd
                    ON p.id = pd.product_id
                WHERE p.status = 1
                    AND p.id IN ($wishlist)
                    AND pd.language_id = ?
                    LIMIT 6";

            $all = R::getAll($sql, [$lang['id']]);
            return $all;
        }
        return [];
    }

    public function delete_from_wishlist(int $id): bool
    {
        $wishlist = self::get_wishlist_ids();
        $key = array_search($id, $wishlist);
        if (false !== $key) {
            unset($wishlist[$key]);
            if (!empty($wishlist)) {
                $wishlist = implode(',', $wishlist);
                setcookie('wishlist', $wishlist, time() + 3600 * 24 * 7 * 30, '/');
            } else {
                setcookie('wishlist', '', time() - 3600, '/');
            }
            return true;
        }
        return false;
    }
}
