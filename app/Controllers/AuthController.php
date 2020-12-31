<?php
namespace App\Controllers;

use App\Models\Redirect;
use Delight\Auth\Auth;
use League\Plates\Engine;
use PDO;


class AuthController {
    private $templates, $pdo, $auth, $redirect;

    public function __construct(PDO $pdo, Engine $engine, Auth $auth, Redirect $redirect){
        $this->templates = $engine;
        $this->pdo = $pdo;
        $this->auth = $auth;
        $this->redirect = $redirect;
    }


    /* Authorization */
    public function login() {
        if ($this->auth->isLoggedIn()) {
            flash()->info('Необходимо выйти!');
            $this->redirect->to('/');die;
        }

        echo $this->templates->render('login', ['title' => 'Войти']);
    }

    public function loginIn() {

        if ($_POST['remember'] == 'on') {
            $rememberDuration = (int) (60 * 60 * 24 * 365.25);
        }
        else {
            $rememberDuration = null;
        }


        try {
            $this->auth->login($_POST['email'], $_POST['password'], $rememberDuration);
            flash()->success('Здравствуйте' . $_POST['email']);
            $this->redirect->to('/');die;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('E-mail или пароль не верный!');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('E-mail или пароль не верный!');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error('Пользователь с E-mail-ом ' .$_POST['email']. ' не прошел подтверждения!');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->warning('Пользователь временно заблокирован, попробуйте позже');
        }

        echo $this->templates->render('login', ['title' => 'Войти']);
    }

    public function logOut() {
        $this->auth->logOut();

        try {
            $this->auth->logOutEverywhereElse();
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->warning('Вы вышли из аккаунта!');
        }

        $this->redirect->to('/');
    }



    /* Authorization */



}