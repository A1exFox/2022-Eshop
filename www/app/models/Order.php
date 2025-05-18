<?php

declare(strict_types=1);

namespace app\models;

use RedBeanPHP\R;
use PHPMailer\PHPMailer\PHPMailer;
use wfm\App;

class Order extends AppModel
{
    public static function saveOrder(array $data): int|false
    {
        R::begin();
        try {
            $order = R::dispense('orders');
            $order->user_id = $data['user_id'];
            $order->note = $data['note'];
            $order->total = $_SESSION['cart.sum'];
            $order->qty = $_SESSION['cart.qty'];
            $order_id = R::store($order);
            self::saveOrderProduct($order_id, $data['user_id']);

            R::commit();
            return $order_id;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public static function saveOrderProduct($order_id, $user_id)
    {
        $sql_part = '';
        $binds = [];
        foreach ($_SESSION['cart'] as $product_id => $product) {
            if ($product['is_download']) {
                $download_id = R::getCell("SELECT download_id FROM product_download WHERE product_id = ?", [$product_id]);
                $order_download = R::xdispense('order_download');
                $order_download->order_id = $order_id;
                $order_download->user_id = $user_id;
                $order_download->product_id = $product_id;
                $order_download->download_id = $download_id;
                R::store($order_download);
            }

            $sum = $product['qty'] * $product['price'];
            $sql_part .= "(?,?,?,?,?,?,?),";
            $binds = array_merge($binds, [$order_id, $product_id, $product['title'], $product['slug'], $product['qty'], $product['price'], $sum]);
        }
        $sql_part = rtrim($sql_part, ",");
        R::exec("INSERT INTO order_product (order_id, product_id, title, slug, qty, price, sum) 
        VALUES $sql_part", $binds);
    }

    public static function mailOrder($order_id, $user_email, $tpl): bool
    {
        $properties = App::$app->getProperties();
        if (
            !isset($properties['smtp_host']) ||
            !isset($properties['smtp_auth']) ||
            !isset($properties['smtp_port']) ||
            !isset($properties['smtp_username']) ||
            !isset($properties['smtp_password']) ||
            !isset($properties['smtp_from_email'])
        ) {
            return false;
        }

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                    //Send using SMTP
            $mail->SMTPDebug = 3;                               //Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->Host       = $properties['smtp_host'];       //Set the SMTP server to send through
            $mail->SMTPAuth   = $properties['smtp_auth'];       //Enable SMTP authentication
            $mail->Username   = $properties['smtp_username'];   //SMTP username
            $mail->Password   = $properties['smtp_password'];   //SMTP password
            $mail->SMTPSecure = null;                           //Enable implicit TLS encryption
            $mail->Port       = $properties['smtp_port'];       //TCP port to connect to

            //Content
            $mail->isHTML(true);                                //Set email format to HTML

            //Recipients
            $mail->setFrom(
                $properties['smtp_from_email'],
                $properties['site_name']
            );
            $mail->addAddress($user_email);                     //Add a recipient

            $mail->Subject = sprintf(___('cart_checkout_mail_subject'), $order_id);

            ob_start();
            require \APP . "/views/mail/$tpl.php";
            $body = ob_get_clean();

            $mail->Body = $body;

            return $mail->send();
        } catch (\Exception $e) {
            // debug($e, true);
            return false;
        }
    }
}
