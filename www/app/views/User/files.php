

/**
 * @var \wfm\View $this
 * @var \wfm\Pagination $pagination
 * @var array $files
 */

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="user/cabinet"> __('tpl_cabinet'); </a></li>
            <li class="breadcrumb-item active"> __('user_files_title'); </li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-12">
            <h1 class="section-title"> __('user_files_title'); </h1>
        </div>

         $this->getPart('parts/cabinet_sidebar'); 

        <div class="col-md-9 order-md-1">

             if (!empty($files)): 

                <div class="table-responsive">
                    <table class="table text-start table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"> __('user_files_num_order'); </th>
                                <th scope="col"> __('user_files_name'); </th>
                                <th scope="col"> __('user_files_download'); </th>
                            </tr>
                        </thead>
                        <tbody>
                             foreach ($files as $file): 
                                <tr>
                                    <td><a href="user/order?id= $file['order_id'] "> $file['order_id'] </a></td>
                                    <td> $file['name'] </td>
                                    <td><a href="user/download?id= $file['id'] "><i class="fas fa-download"></i></a></td>
                                </tr>
                             endforeach; 
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p> count($files)   __('user_files_total_pagination');   $total; </p>
                         if ($pagination->countPages > 1): 
                             $pagination; 
                         endif; 
                    </div>
                </div>

             else: 
                <p> __('user_files_empty'); </p>
             endif; 

        </div>
    </div>
</div>
