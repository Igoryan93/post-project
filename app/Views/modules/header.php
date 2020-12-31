<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
    <a class="navbar-brand d-flex align-items-center fw-500" href="/"><img alt="logo" class="d-inline-block align-top mr-2" src="/img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == '/') echo 'active' ?>">
                <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
            </li>
            <?php if($_SESSION['auth_logged_in'] === true):?>
                <li class="nav-item <?php if(strpos($_SERVER['REQUEST_URI'], '/profile/') !== false) echo 'active' ?>">
                    <a class="nav-link" href="/profile/<?php echo $_SESSION['auth_user_id']?>">Профиль <span class="sr-only">(current)</span></a>
                </li>
            <?php endif; ?>

        </ul>

        <ul class="navbar-nav ml-auto">
            <?php if($_SESSION['auth_logged_in'] === true): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выйти</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Войти</a>
                </li>
                <li>
                    <a class="nav-link" href="/reg">Зарегистрироваться</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>