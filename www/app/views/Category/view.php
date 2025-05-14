<?php

/** 
 * @var string $breadcrumbs 
 * @var array $category
 * @var array $products
 * @var int $total
 * @var \wfm\Pagination $pagination
 * @var \wfm\View $this
 * */
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadcrumbs ?>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title"><?= $category['title'] ?></h3>

            <?php if (!empty($category['content'])): ?>
                <div class="category_desc">
                    <?= $category['content'] ?>
                </div>
                <hr>
            <?php endif; ?>

            <?php if (!empty($products) && (count($products) > 1 || $pagination->countPages > 1)): ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <?php
                            $sort = [
                                'title_asc' => '',
                                'title_desc' => '',
                                'price_asc' => '',
                                'price_desc' => '',
                            ];
                            if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $sort)) {
                                $sort[$_GET['sort']] = 'selected';
                            }
                            ?>
                            <label class="input-group-text" for="input-sort"><?= ___('category_view_sort') ?>:</label>
                            <select class="form-select" id="input-sort">
                                <option value="sort=default" selected=""><?= ___('category_view_sort_by_default') ?></option>
                                <option value="sort=title_asc"
                                    <?= $sort['title_asc'] ?>>
                                    <?= ___('category_view_sort_title_asc') ?>
                                </option>
                                <option value="sort=title_desc"
                                    <?= $sort['title_desc'] ?>>
                                    <?= ___('category_view_sort_title_desc') ?>
                                </option>
                                <option value="sort=price_asc"
                                    <?= $sort['price_asc'] ?>>
                                    <?= ___('category_view_sort_price_asc') ?>
                                </option>
                                <option value="sort=price_desc"
                                    <?= $sort['price_desc'] ?>>
                                    <?= ___('category_view_sort_price_desc') ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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
                    <p><?= ___('category_view_no_products') ?></p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>