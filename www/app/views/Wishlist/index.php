<?php

/** 
 * 
 * */
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="base_url()"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item">'wishlist_index_title'</li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title">'wishlist_index_title'</h3>

            <div class="row">
                !empty($products)
                    'parts/products_loop'

                else:
                    <p>'wishlist_index_not_found'</p>
                endif;
            </div>

        </div>

    </div>
</div>
