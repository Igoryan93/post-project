<?php
namespace App\Controllers;

use App\Models\ImageUpload;
use App\Models\Redirect;
use App\Models\Validate;
use Delight\Auth\Auth;
use function foo\func;
use Intervention\Image\ImageManager;
use League\Plates\Engine;
use App\Models\QueryBuilder;
use SimpleMail;

class UserController {
    private $templates, $queryBuilder, $validate, $imageManager, $redirect;

    public function __construct(Engine $engine, QueryBuilder $queryBuilder, Validate $validate, Auth $auth, ImageManager $imageManager, ImageUpload $imageUpload, Redirect $redirect) {
        $this->templates = $engine;
        $this->queryBuilder = $queryBuilder;
        $this->validate = $validate;
        $this->auth = $auth;
        $this->imageManager = $imageManager;
        $this->imageUpload = $imageUpload;
        $this->redirect = $redirect;
    }


    /* Profile user */
    public function profile($id) {
        if($_SESSION['auth_user_id'] != $id['id'] && $_SESSION['auth_roles'] != 1) {
            flash()->error('У вас недостаточно прав!');
            $this->redirect->to('/'); die;
        }
        $user = $this->queryBuilder->selectOne('users', $id['id']);
        echo $this->templates->render('profile', ['user' => $user]);
    }
    /* Profile user */


    /* Edit user */

    public function editUser($id) {
        if($_SESSION['auth_user_id'] != $id['id'] && $_SESSION['auth_roles'] != 1) {
            flash()->error('У вас недостаточно прав!');
            $this->redirect->to('/'); die;
        }
        $user = $this->queryBuilder->selectOne('users', $id['id']);
        echo $this->templates->render('edit', ['user' => $user]);
    }

    public function editUserChange($id) {
        $validate = $this->validate->check($_POST, [
            'username' => [
                'required', 'min_length(3)', 'max_length(30)'
            ],
            'company' => [
                'required', 'min_length(3)', 'max_length(50)'
            ],
            'phone' => [
                'required', 'min_length(7)', 'max_length(20)'
            ],
            'address' => [
                'required', 'min_length(5)', 'max_length(70)'
            ]
        ]);

        if($validate === true) {
            $this->queryBuilder->update('users', $id['id'], $_POST);
            flash()->success('Ваши данные были успешно обновлены');
        } else {
            flash()->error($validate[0]);
        }

        $this->redirect->to('/edit/' . $id['id']);
    }

    /* Edit user */



    /* Security user */

    public function securityUser($id) {
        if($_SESSION['auth_user_id'] != $id['id'] && $_SESSION['auth_roles'] != 1) {
            flash()->error('У вас недостаточно прав!');
            $this->redirect->to('/'); die;
        }
        $user = $this->queryBuilder->selectOne('users', $id['id']);
        echo $this->templates->render('security', ['user' => $user]);
    }

    public function securityChange($id) {

        $validate = $this->validate->check($_POST, [
            'old_password' => [
                'required'
            ],
            'new_password' => [
                'required', 'min_length(6)', 'max_length(20)'
            ],
            'password_verify' => [
                'required', 'equals(:new_password)'
            ]
        ]);

        if($validate === true) {
            $user = $this->queryBuilder->selectOne('users', $id['id']);
            if(!empty($user) && $user['id'] !== $id['id']) {
                flash()->error('Такой E-mail уже занят');
            } elseif($_SESSION['auth_roles'] === 1) {
                try {
                    $this->auth->admin()->changePasswordForUserById($id['id'], $_POST['new_password']);
                    flash()->success('Пароль был успешно изменен');
                }
                catch (\Delight\Auth\UnknownIdException $e) {
                    flash()->error('Пользователь с таким ID не найден');
                }
                catch (\Delight\Auth\InvalidPasswordException $e) {
                    flash()->error('Ошибка пароля');
                }
            } else {
                try {
                    $this->auth->changePassword($_POST['old_password'], $_POST['new_password']);
                    flash()->success('Ваши данные успешно обновлены');
                }
                catch (\Delight\Auth\NotLoggedInException $e) {
                    flash()->error('Not logged in');
                }
                catch (\Delight\Auth\InvalidPasswordException $e) {
                    flash()->error(['Не верный текущий пароль']);
                }
                catch (\Delight\Auth\TooManyRequestsException $e) {
                    false()->error('Слишком много попыток');
                }
            }

        } else {
            flash()->error($validate[0]);
        }

        $this->redirect->to('/security/' . $id['id']);

    }

    /* Security user */



    /* Status user */

    public function statusUser($id) {
        if($_SESSION['auth_user_id'] != $id['id'] && $_SESSION['auth_roles'] != 1) {
            flash()->error('У вас недостаточно прав!');
            $this->redirect->to('/'); die;
        }

        $user = $this->queryBuilder->selectOne('users', $id['id']);

        echo $this->templates->render('status', ['user' => $user]);
    }

    public function statusChange($id) {
        $status = $this->queryBuilder->update('users', $id['id'], $_POST);
        if($status !== false) {
            flash()->success('Ваш статус был успешно изменен');
            $this->redirect->to('/status/' . $id['id']);
        }

    }

    /* Status user */



    /* Media user */

    public function mediaUser($id) {
        if($_SESSION['auth_user_id'] == $id['id'] || $_SESSION['auth_roles'] == 1) {
            $user = $this->queryBuilder->selectOne('users', $id['id']);
        } else {
            flash()->error('У вас недостаточно прав!');
            $this->redirect->to('/');die;
        }
        echo $this->templates->render('media', ['user' => $user]);
    }

    public function mediaUpload($id) {
        $image = $this->imageUpload->upload($id['id'], $_FILES['image']['tmp_name'], $_FILES['image']['name']);

        if($image == true) {
            flash()->success('Ваше изображение успешно изменено');
        } else {
            flash()->error('Чтобы изменения вступили в силу, прикрепите изображение');
        }

        $this->redirect->to('/media/' . $id['id']);


    }

    /* Media user */

    /* Delete user */
    public function deleteUser($id) {
        if($_SESSION['auth_user_id'] == $id['id'] || $_SESSION['auth_roles'] == 1) {
            $this->queryBuilder->delete('users', $id['id']);
            flash()->success('Пользователь успешно удален');

            if($_SESSION['auth_roles'] !== 1) {
                $this->auth->logOut();
            }

            $this->redirect->to('/');die;
        }

        flash()->error('У вас недостаточно прав');
        $this->redirect->to('/');
    }
    /* Delete user */


}