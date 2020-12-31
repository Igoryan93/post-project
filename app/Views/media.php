<?php $this->layout('layout', ['title' => 'Загрузка аватара']) ?>
<?php d($user['id']) ?>
<style>
    .form-group img {
        width: auto;
        height: auto;
        max-width: 600px;
    }
</style>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-image'></i> Загрузить аватар
    </h1>

</div>
<form action="/media/<?php echo $user['id']?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Текущий аватар</h2>
                    </div>
                    <div class="panel-content">
                        <?= flash()->display(); ?>
                        <div class="form-group">
                            <?php if($user['image'] == null): ?>
                                <img src="/img/no_avatar.png" alt="no_avatar.png">
                            <?php else: ?>
                                <img src="/img/<?php echo $user['image']?>" alt="" class="img-responsive" width="200">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="example-fileinput">Выберите аватар</label>
                            <input type="file" id="example-fileinput" name="image" class="form-control-file">
                        </div>


                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button class="btn btn-warning">Загрузить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>