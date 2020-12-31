<?php
namespace App\Controllers;

use App\Models\ImageUpload;
use App\Models\Redirect;
use App\Models\Validate;
use Delight\Auth\Auth;
use League\Plates\Engine;
use App\Models\QueryBuilder;

class AdminController {
    private $queryBuilder, $templates, $validate, $redirect, $auth, $imageUpload;

    public function __construct(QueryBuilder $queryBuilder, Engine $engine, Validate $validate, Redirect $redirect, Auth $auth, ImageUpload $imageUpload){
        $this->queryBuilder = $queryBuilder;
        $this->templates = $engine;
        $this->validate= $validate;
        $this->redirect = $redirect;
        $this->auth = $auth;
        $this->imageUpload = $imageUpload;
    }

    public function createUser() {
        if($_SESSION['auth_roles'] != 1) {
            flash()->error('У вас недостаточно прав!');
            $this->redirect->to('/'); die;
        }
        echo $this->templates->render('create', ['title' => 'Добавить пользователя']);
    }

    public function create() {
        $validate = $this->validate->check($_POST, [
            'username' => ['required', 'min_length(3)', 'max_length(50)'],
            'company' => ['required', 'min_length(3)', 'max_length(50)'],
            'phone'   => ['required', 'min_length(7)', 'max_length(20)'],
            'address'   => ['required', 'min_length(7)', 'max_length(30)'],
            'email'   => ['required', 'email'],
            'password'   => ['required', 'min_length(3)'],
            'password_again'   => ['required', 'equals(:password)']
        ]);


        if($validate === true) {
            $user = $this->queryBuilder->selectOneByEmail('users', $_POST);
            if(!empty($user)) {
                flash()->error('Пользователь с таким E-mail-ом уже занят');
                $this->redirect->to('/create'); die;
            }


            try {
                $userId = $this->auth->admin()->createUser(
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['username']
                );

                $this->queryBuilder->update('users', $userId, [
                    'company'    => $_POST['company'],
                    'address'    => $_POST['address'],
                    'phone'      => $_POST['phone'],
                    'vkontakte'  => $_POST['vkontakte'],
                    'telegram'   => $_POST['telegram'],
                    'instagram'  => $_POST['instagram'],
                    'state'      => $_POST['state'],
                    'roles_mask' => $_POST['roles_mask']

                ]);

                $this->imageUpload->upload($userId, $_FILES['image']['tmp_name'], $_FILES['image']['name']);

                flash()->success('Пользователь с идентификатором успешно зарегистрирован ' . $userId);
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->error('Ошибка E-mail');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {;
                flash()->error('Пароль не коректен');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                flash()->error('Пользователь с таким E-mail-ом уже занят');
            }

        } else {
            flash()->error($validate[0]);
        }

        $this->redirect->to('/create');

    }

}