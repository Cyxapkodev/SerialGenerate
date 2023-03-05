<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/edit/<?php echo $data['id']; ?>" method="post" >
                            <div class="form-group">
                                <label>Код</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['pu'], ENT_QUOTES); ?>" name="pu">
                            </div>
                            <div class="form-group">
                                <label>Модуль</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['pcb'], ENT_QUOTES); ?>" name="pcb">
                            </div>
                            <div class="form-group">
                                <label>Плата</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['module'], ENT_QUOTES); ?>" name="module">
                            </div><div class="form-group">
                                <label>Код</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['code'], ENT_QUOTES); ?>" name="code">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>