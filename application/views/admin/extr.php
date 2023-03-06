<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="/admin/extr"  method="post">
                            
                            <div class="form-group">
                                <label>Файли CSV</label>
                                <input class="form-control" type="file" name="file">
                            </div>
                            <button type="submit"   class="btn btn-primary btn-block">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>