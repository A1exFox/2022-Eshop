<?php

/** 
 * @var $this \wfm\View */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= ADMIN ?>/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= PATH ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= PATH ?>/adminlte/dist/css/adminlte.min.css">
    <link rel="icon" href="<?= PATH ?>/assets/img/favicon.ico" type="image/x-icon">
</head>

<body class="hold-transition login-page">

    <?= $this->content ?>

    <script src="<?= PATH ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?= PATH ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PATH ?>/adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>