<?php
namespace App\Controllers;

use App\Models\Redirect;
use Delight\Auth\Auth;
use League\Plates\Engine;
use PDO;
use SimpleMail;


class RegController {
    private $pdo, $templates, $auth, $redirect;

    public function __construct(PDO $pdo, Engine $engine, Auth $auth, Redirect $redirect) {
        $this->templates = $engine;
        $this->pdo = $pdo;
        $this->auth = $auth;
        $this->redirect = $redirect;
    }

    /* Registration */

    public function registration() {
        if ($this->auth->isLoggedIn()) {
            flash()->info('Необходимо выйти!');
            $this->redirect->to('/');die;
        }
        echo $this->templates->render('reg', ['title' => 'Регистрация']);
    }

    public function create() {
        if(strlen($_POST['password']) < 6 ) {
            flash()->error('Минимальное количетсво символов в поле Пароль должна быть 6');
            echo $this->templates->render('reg', ['title' => 'Регистрация']);die;
        } else {
            try {

                $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {

                    SimpleMail::make()
                        ->setTo($_POST['email'], 'Чувак!')
                        ->setFrom('test@test.com', 'Test')
                        ->setSubject('Письмо для подтверждения письма')
                        ->setMessage('Для подтверждения почты перейдите по <a href="http://post-project/verify/' .$selector. '/'.$token.'">сылке </a>')
                        ->setHtml()
                        ->send();
                });
                flash()->warning('Письмо с подтверждением было отправлено на E-mail ' . $_POST['email']);

            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->error('Поле E-mail не корректно!');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->error('Поле пароля не корректно!');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                flash()->error('Пользователь с таким E-mail уже существует!');
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                flash()->error('Слишком много попыток зарегистрироваться!');
            }
        }

        echo $this->templates->render('reg', ['title' => 'Регистрация']);
    }

    public function emailVerification($vars) {
        try {
            $this->auth->confirmEmail($vars['selector'], $vars['token']);
            flash()->success('Регистрация успешна!');
            $this->redirect->to('/login');
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error('Токен не актуален!');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error('Токен уже использован!');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->info('E-mail уже подтвержден!');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Слишком много попыток!');
        }

    }

    /* Registration */
}