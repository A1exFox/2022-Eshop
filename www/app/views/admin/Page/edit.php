<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">
            <div class="card card-info card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <?php foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($lang['base']) echo 'active' ?>" data-toggle="pill"
                                    href="#<?= $k ?>">
                                    <img src="<?= PATH ?>/assets/img/lang/<?= $k ?>.png" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <?php foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): ?>
                            <div class="tab-pane fade <?php if ($lang['base']) echo 'active show' ?>" id="<?= $k ?>">

                                <div class="form-group">
                                    <label class="required" for="title">Наименование страницы</label>
                                    <input type="text" name="page_description[<?= $lang['id'] ?>][title]"
                                        class="form-control" id="title" placeholder="Наименование страницы"
                                        value="<?= h((string)$page[$lang['id']]['title']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Мета-описание</label>
                                    <input type="text" name="page_description[<?= $lang['id'] ?>][description]"
                                        class="form-control" id="description" placeholder="Мета-описание"
                                        value="<?= h((string)$page[$lang['id']]['description']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Ключевые слова</label>
                                    <input type="text" name="page_description[<?= $lang['id'] ?>][keywords]"
                                        class="form-control" id="keywords" placeholder="Ключевые слова"
                                        value="<?= h((string)$page[$lang['id']]['keywords']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="content">Контент страницы</label>
                                    <textarea name="page_description[<?= $lang['id'] ?>][content]"
                                        class="form-control editor" id="content" rows="3"
                                        placeholder="Контент страницы"><?= h((string)$page[$lang['id']]['content']) ?></textarea>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>

        </form>

    </div>

</div>
<!-- /.card -->

<?php if (is_file(WWW . '/adminlte/ckfinder/ckfinder.js')): ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src="<?= PATH ?>/adminlte/ckfinder/ckfinder.js"></script>
    <script type="text/javascript">
        document.querySelectorAll('.editor').forEach((node, index) => {
            ClassicEditor
                .create(node, {
                    ckfinder: {
                        uploadUrl: '<?= PATH ?>/adminlte/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                    },
                    toolbar: [
                        "undo", "redo", "|",
                        "ckfinder", "imageUpload", "|",
                        "bold", "italic", "heading", "|",
                        "blockQuote", "numberedList", "bulletedList", "insertTable", "|",
                        "link", "mediaEmbed"
                    ]
                })
                .catch(function(error) {
                    console.error(error);
                });
        });
    </script>
<?php else: ?>
    <script>
        console.error("File: \"<?= PATH ?>/adminlte/ckfinder/ckfinder.js\" not found.\nMore info in readme.md")
    </script>
<?php endif; ?>