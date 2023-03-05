<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="/admin/extr" enctype="multipart/form-data" method="post">
                            
                            <div class="form-group">
                                <label>Файли CSV</label>
                                <input class="form-control" type="file" name="file">
                            </div>
                            <button type="submit" name="submit" value="Upload" class="btn btn-primary btn-block">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>