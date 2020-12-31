<?php $this->layout('layout', ['title' => 'Статус пользователя']) ?>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-sun'></i> Установить статус
    </h1>

</div>
<form action="/status/<?php echo $user['id'] ?>" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Установка текущего статуса</h2>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- status -->
                                <div class="form-group">
                                    <?= flash()->display(); ?>
                                    <label class="form-label" for="example-select">Выберите статус</label>
                                    <select class="form-control" id="example-select" name="state">
                                        <?php if($user['state'] == 0) : ?>
                                            <option value="0" selected>Онлайн </option>
                                            <option value="1">Отошел</option>
                                            <option value="2">Не беспокоить</option>
                                        <?php elseif($user['state'] == 1): ?>
                                            <option value="0" >Онлайн </option>
                                            <option value="1" selected>Отошел</option>
                                            <option value="2">Не беспокоить</option>
                                        <?php else: ?>
                                            <option value="0" >Онлайн </option>
                                            <option value="1" >Отошел </option>
                                            <option value="2" selected>Не беспокоить</option>
                                        <?php endif; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning">Set Status</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>