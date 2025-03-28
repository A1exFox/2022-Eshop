<?php

declare(strict_types=1);

namespace app\controllers\admin;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        echo "<h1>ADMIN AREA</h1>";
    }
}
