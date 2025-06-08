<?php

declare(strict_types=1);

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Slider extends AppModel
{
    public function get_slides(): array
    {
        return R::getAssoc("SELECT * FROM slider");
    }

    public function update_slider()
    {
        if (!isset($_POST['gallery'])) {
            R::exec("DELETE FROM slider");
        }
        if (isset($_POST['gallery']) && is_array($_POST['gallery'])) {
            $gallery = $this->get_slides();
            if ((count($gallery) !== count($_POST['gallery'])) ||
                array_diff($gallery, $_POST['gallery']) ||
                array_diff($_POST['gallery'], $gallery)
            ) {
                R::exec("DELETE FROM slider");
                $sql = "INSERT INTO slider (img) VALUES ";
                foreach ($_POST['gallery'] as $item) {
                    $sql .= "(?),";
                }
                $sql = rtrim($sql, ',');
                R::exec($sql, $_POST['gallery']);
            }
        }
    }
}
