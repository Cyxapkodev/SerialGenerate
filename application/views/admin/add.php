<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/add" method="post">
                            <div class="form-group">
                                <label>Модель </label>
                                <input class="form-control" type="text" name="pu">
                            </div>
                            <div class="form-group">
                                <label>Плата</label>
                                <input class="form-control" type="text" name="pcb">
                            </div>
                            <div class="form-group">
                                <label>Модуль</label>
                                <input class="form-control" type="text" name="module">
                            </div>
                        
                            <div class="form-group">
                                <label>Код</label>
                                <input class="form-control" type="text" name="code">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>