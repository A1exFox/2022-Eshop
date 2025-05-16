<?php

/** 
 * @var array $products
 * @var \wfm\View $this
 * */
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= ___('wishlist_index_title') ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title"><?= ___('wishlist_index_title') ?></h3>

            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php $this->getPart('parts/products_loop', compact('products')) ?>

                <?php else: ?>
                    <p><?= ___('wishlist_index_not_found') ?></p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>