<?php $this->layout('layout', ['title' => 'Страница профиля']) ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-user'></i> <?php echo $user['username'] ?>
    </h1>
</div>
<div class="row">
    <div class="col-lg-6 col-xl-6 m-auto">
        <!-- profile summary -->
        <div class="card mb-g rounded-top">
            <div class="row no-gutters row-grid">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <img src="/img/<?php echo $user['image']?>" class="rounded-circle shadow-2 img-thumbnail" alt="">
                        <h5 class="mb-0 fw-700 text-center mt-3">
                            <?php echo $user['username']?>
                            <small class="text-muted mb-0"><?php echo $user['company']?></small>
                        </h5>
                        <div class="mt-4 text-center demo">
                            <a href="<?php echo $user['instagram']?>" class="fs-xl" style="color:#C13584">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="<?php echo $user['vkontakte']?>" class="fs-xl" style="color:#4680C2">
                                <i class="fab fa-vk"></i>
                            </a>
                            <a href="<?php echo $user['telegram']?>" class="fs-xl" style="color:#0088cc">
                                <i class="fab fa-telegram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 text-center">
                        <a href="tel:<?php echo $user['phone']?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                            <i class="fas fa-mobile-alt text-muted mr-2"></i> <?php echo $user['phone']?></a>
                        <a href="mailto:<?php echo $user['email']?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                            <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?php echo $user['email']?></a>
                        <address class="fs-sm fw-400 mt-4 text-muted">
                            <i class="fas fa-map-pin mr-2"></i> <?php echo $user['address']?>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
