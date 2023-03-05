<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Приборы</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-10">
                        <?php if (empty($list)): ?>
                            <p>Список устроиств пуст</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Название прибора</th>
                                    <th>Код</th>
                                    <th>Редактировать</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td ><?php echo htmlspecialchars($val['pu'], ENT_QUOTES); ?></td>
                                        <td ><?php echo htmlspecialchars($val['code'], ENT_QUOTES); ?></td>
                                        <td ><a href="/admin/edit/<?php echo $val['id']; ?>" class="btn btn-outline-primary">Редактировать</a></td>
                                        <td ><a href="/admin/delete/<?php echo $val['id']; ?>" class="btn btn-outline-danger">Удалить</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>