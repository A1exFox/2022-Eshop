<?php

/** 
 * @var array $products
 * @var int $total
 * @var \wfm\Pagination $pagination
 * @var \wfm\View $this
 * @var string $s
 * */
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= ___('search_index_title') ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title"><?= ___('search_index_title') ?></h3>
            <h4><?= ___('search_index_query') . h($s) ?></h4>

            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php $this->getPart('parts/products_loop', compact('products')) ?>

                    <div class="row">
                        <div class="col-md-12">
                            <p><?= sprintf('%d %s %d', count($products), ___('tpl_total_pagination'), $total) ?></p>
                            <?php if ($pagination->countPages > 1): ?>
                                <?= $pagination ?>
                            <?php endif; ?>
                        </div>

                    </div>

                <?php else: ?>
                    <p><?= ___('search_index_not_found') ?></p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>