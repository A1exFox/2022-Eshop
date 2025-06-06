<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Download extends AppModel
{
    public function get_downloads(array $lang, int $start, $perpage): array
    {
        return R::getAll("SELECT d.*,dd.* 
            FROM download d
            JOIN download_description dd
                ON d.id = dd.download_id
            WHERE dd.language_id = ?
                LIMIT $start,$perpage", [$lang['id']]);
    }

    public function download_validate(): bool
    {
        $errors = '';
        foreach ($_POST['download_description'] as $lang_id => $item) {
            $item['name'] = trim($item['name']);
            if (empty($item['name'])) {
                $errors .= "Не заполнено наименование $lang_id<br>";
            }
        }
        if (empty($_FILES) || $_FILES['file']['error']) {
            $errors .= "Ошибка загрузки файла<br>";
        } else {
            $extensions = ['jpg', 'jpeg', 'png', 'zip', 'pdf', 'txt'];
            $parts = explode('.', $_FILES['file']['name']);
            $ext = end($parts);
            if (!in_array($ext, $extensions)) {
                $errors .= "Допустимые для загрузки расширения jpg, jpeg, png, zip, pdf, txt<br>";
            }
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            return false;
        }
        return true;
    }

    public function upload_file(): array|false
    {
        $file_name = $_FILES['file']['name'] . uniqid();
        $path = WWW . '/downloads/' . $file_name;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            return [
                'original_name' => $_FILES['file']['name'],
                'filename' => $file_name,
            ];
        }
        return false;
    }

    public function save_download($data): bool
    {
        R::begin();
        try {
            $download = R::dispense('download');
            $download->filename = $data['filename'];
            $download->original_name = $data['original_name'];
            $download_id = R::store($download);

            foreach ($_POST['download_description'] as $lang_id => $item) {
                R::exec("INSERT INTO download_description (download_id, language_id, name)
                    VALUES (?,?,?)", [$download_id, $lang_id, $item['name']]);
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public function download_delete($id): bool
    {
        //FIXME: Неправильный порядок (удаление из таблиц, удаление файла)
        $file_name = R::getCell("SELECT filename
            FROM download
            WHERE id = ?", [$id]);
        $file_path = WWW . "/downloads/$file_name";
        if (file_exists($file_path)) {
            R::begin();
            try {
                R::exec("DELETE FROM download_description WHERE download_id = ?", [$id]);
                R::exec("DELETE FROM download WHERE id = ?", [$id]);
                //FIXME: Можно обойтись одним запросом
                $products = R::getCol("SELECT product_id FROM product_download WHERE download_id = ?", [$id]);
                if (!empty($products)) {
                    $str = str_repeat('?,', count($products));
                    $str = rtrim($str, ',');
                    R::exec("UPDATE product SET is_download = 0 WHERE id IN ($str)", $products);
                }
                R::exec("DELETE FROM product_download WHERE download_id = ?", [$id]);

                R::commit();
                unlink($file_path);
                return true;
            } catch (\Exception $e) {
                R::rollback();
                return false;
            }
        }
        return false;
    }
}
