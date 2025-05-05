<?php

/**
 * @var array $category
 * @var string $tab
 * @var app\widgets\menu\Menu $this
 */
if (!isset($category['children'])): ?>
    <li class="nav-item">
        <a class="nav-link" href="category/<?= $category['slug'] ?>">
            <?= $category['title'] ?>
        </a>
    </li>
<?php else: ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="category/<?= $category['slug'] ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $category['title'] ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?= $this->getMenuHtml($category['children']) ?>
        </ul>
    </li>
<?php endif; ?>