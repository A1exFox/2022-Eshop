

/**
 * $var array $category
 */


<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">

            <div class="form-group">
                <label class="required" for="parent_id">Родительская категория</label>
                 new \app\widgets\menu\Menu([
                    'cache' => 0,
                    'cacheKey' => 'admin_menu_select',
                    'class' => 'form-control',
                    'container' => 'select',
                    'attrs' => [
                        'name' => 'parent_id',
                        'id' => 'parent_id',
                        'required' => 'required',
                    ],
                    'prepend' => '<option value="0">Самостоятельная категория</option>',
                    'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
                ]) 
            </div>

            <div class="card card-info card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                         foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): 
                            <li class="nav-item">
                                <a class="nav-link  if ($lang['base']) echo 'active' " data-toggle="pill" href="# $k ">
                                    <img src=" PATH /assets/img/lang/ $k .png" alt="">
                                </a>
                            </li>
                         endforeach; 
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                         foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): 
                            <div class="tab-pane fade  if ($lang['base']) echo 'active show' " id=" $k ">

                                <div class="form-group">
                                    <label class="required" for="title">Наименование</label>
                                    <input type="text"
                                        name="category_description[ $lang['id'] ][title]"
                                        class="form-control"
                                        id="title"
                                        placeholder="Наименование категории"
                                        value=" h((string)$category[$lang['id']]['title']) ">
                                </div>

                                <div class="form-group">
                                    <label for="description">Мета-описание</label>
                                    <input type="text"
                                        name="category_description[ $lang['id'] ][description]"
                                        class="form-control"
                                        id="description"
                                        placeholder="Мета-описание"
                                        value=" h((string)$category[$lang['id']]['description']) ">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Ключевые слова</label>
                                    <input type="text"
                                        name="category_description[ $lang['id'] ][keywords]"
                                        class="form-control"
                                        id="keywords"
                                        placeholder="Ключевые слова"
                                        value=" h((string)$category[$lang['id']]['keywords']) ">
                                </div>

                                <div class="form-group">
                                    <label for="content">Описание категории</label>
                                    <textarea name="category_description[ $lang['id'] ][content]"
                                        class="form-control editor"
                                        id="content"
                                        rows="3"
                                        placeholder="Описание категории"> h((string)$category[$lang['id']]['content']) </textarea>
                                </div>

                            </div>
                         endforeach; 
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>

        </form>

    </div>

</div>
<!-- /.card -->
 if (is_file(WWW . '/adminlte/ckfinder/ckfinder.js')): 
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src=" PATH /adminlte/ckfinder/ckfinder.js"></script>
    <script type="text/javascript">
 
    document.querySelectorAll('.editor').forEach((node, index) => {
        ClassicEditor
        .create( node, {
            ckfinder: {
                uploadUrl: ' PATH /adminlte/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: [
                "undo", "redo", "|",
                "ckfinder", "imageUpload", "|",
                "bold", "italic", "heading", "|",
                "blockQuote", "numberedList", "bulletedList", "insertTable", "|",
                "link", "mediaEmbed"
            ]
        } )
        .catch( function( error ) {
            console.error( error );
        } );
    });
    </script>
 else: 
    <script>
        console.error("File: \" PATH /adminlte/ckfinder/ckfinder.js\" not found.\nMore info in readme.md")
    </script>
 endif; 
