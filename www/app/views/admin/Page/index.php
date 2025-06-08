<!-- Default box -->
<div class="card">

    <div class="card-header">
        <a href=" ADMIN /page/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить страницу</a>
    </div>

    <div class="card-body">

         if (!empty($pages)): 
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Наименование</th>
                            <td width="50"><i class="fas fa-pencil-alt"></i></td>
                            <td width="50"><i class="far fa-trash-alt"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                         foreach ($pages as $page): 
                            <tr>
                                <td> $page['id'] </td>
                                <td>
                                     $page['title'] 
                                </td>
                                <td width="50">
                                    <a class="btn btn-info btn-sm"
                                        href=" ADMIN /page/edit?id= $page['id'] "><i
                                            class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td width="50">
                                    <a class="btn btn-danger btn-sm delete"
                                        href=" ADMIN /page/delete?id= $page['id'] ">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                         endforeach; 
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p> count($pages)  страниц(а) из:  $total; </p>
                     if ($pagination->countPages > 1): 
                         $pagination; 
                     endif; 
                </div>
            </div>

         else: 
            <p>Страниц не найдено...</p>
         endif; 

    </div>
</div>
<!-- /.card -->