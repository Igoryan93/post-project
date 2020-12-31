<?php $this->layout('layout', ['title' => 'Безопасность пользователя']) ?>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-lock'></i> Безопасность
    </h1>

</div>
<form action="/security/<?php echo $user['id']; ?>" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Обновление эл. адреса и пароля</h2>
                    </div>
                    <div class="panel-content">
                        <?= flash()->display() ?>

                        <!-- email -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Email</label>
                            <input type="text" id="simpleinput" name="email" disabled class="form-control" value="<?php echo $user['email'] ?>">
                        </div>

                        <!-- old password -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Старый пароль</label>
                            <input type="password" name="old_password" id="simpleinput" class="form-control">
                        </div>

                        <!-- password -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Новый пароль</label>
                            <input type="password" name="new_password" id="simpleinput" class="form-control">
                        </div>

                        <!-- password confirmation-->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                            <input type="password" name="password_verify" id="simpleinput" class="form-control">
                        </div>

                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button class="btn btn-warning">Изменить</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>