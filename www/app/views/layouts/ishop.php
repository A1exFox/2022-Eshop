<?php

/** @var wfm\View $this */
?>
<?php $this->getPart('parts/header') ?>

<div class="container">
    <div class="row">
        <div class="col">
            
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    'errors'
                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            

            
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    'success'
                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            
        </div>
    </div>
</div>

<?= $this->content ?>

<?php $this->getPart('parts/footer'); ?>
