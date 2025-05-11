<?php

declare(strict_types=1);

namespace app\models;

class Cart extends AppModel
{
    public function get_product(int $id, array $lang): ?array
    {
        $sql = "SELECT p.*, pd.*
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.status = 1
                AND p.id = ?
                AND pd.language_id = ?";
        $res = \RedBeanPHP\R::getRow($sql, [$id, $lang['id']]);
        return $res;
    }

    public function add_to_cart(array $product, int $qty = 1): bool
    {
        $qty = abs($qty);

        if ($product['is_download'] && isset($_SESSION['cart'][$product['id']])) {
            return false;
        }

        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            if ($product['is_download']) {
                $qty = 1;
            }
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'qty' => $qty,
                'img' => $product['img'],
                'is_download' => $product['is_download'],
            ];
        }

        if (empty($_SESSION['cart.qty'])) {
            $_SESSION['cart.qty'] = $qty;
        } else {
            $_SESSION['cart.qty'] += $qty;
        }

        if (empty($_SESSION['cart.sum'])) {
            $_SESSION['cart.sum'] = $qty * $product['price'];
        } else {
            $_SESSION['cart.sum'] += $qty * $product['price'];
        }

        return true;
    }

    public function delete_item(int $id): void
    {
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $sum_minus = $_SESSION['cart'][$id]['price'] * $qty_minus;
        $_SESSION['cart.qty'] -= $qty_minus;
        $_SESSION['cart.sum'] -= $sum_minus;
        unset($_SESSION['cart'][$id]);
    }

    public static function translate_cart(array $lang)
    {
        if (empty($_SESSION['cart'])) {
            return;
        }
        $ids = implode(',', array_keys($_SESSION['cart']));
        $sql = "SELECT p.id, pd.title
            FROM product p
            JOIN product_description pd
                ON p.id = pd.product_id
            WHERE p.id 
                    IN ($ids)
                AND pd.language_id = ?";
        $products = \RedBeanPHP\R::getAll($sql, [$lang['id']]);

        foreach ($products as $product) {
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }
    }
}
