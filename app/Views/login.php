<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Войти
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="css/page-login-alt.css">
    <?= $this->insert('modules/styles') ?>
</head>
<body>
<div class="blankpage-form-field">
    <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
            <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">Учебный проект</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <?= flash()->display(); ?>
        <form action="/login" method="POST">
            <div class="form-group">
                <label class="form-label" for="username">Email</label>
                <input type="email" id="username" class="form-control" name="email" placeholder="Эл. адрес" value="">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="" >
            </div>
            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="rememberme">
                    <label class="custom-control-label" for="rememberme">Запомнить меня</label>
                </div>
            </div>
            <button type="submit" class="btn btn-default float-right">Войти</button>
        </form>
    </div>
    <div class="blankpage-footer text-center">
        Нет аккаунта? <a href="/reg"><strong>Зарегистрироваться</strong>
    </div>
</div>
<video poster="img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
    <source src="media/video/cc.webm" type="video/webm">
    <source src="media/video/cc.mp4" type="video/mp4">
</video>
<?= $this->insert('modules/scripts') ?>
</body>
</html>
