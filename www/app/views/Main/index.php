<?php

/** @var array $names */

?>

<h1>Hello view/Main/index.php</h1>

<?php if (!empty($names)): ?>
    <?php foreach ($names as $name): ?>
        <?= $name->id ?> : <?= $name->name ?><br>
    <?php endforeach; ?>
<?php endif; ?>