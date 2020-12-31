<?php
namespace App\Models;
use SimpleValidator\Validator;

class Validate {

    public function check($data, $rules) {
        $naming = [
            'username' => 'Имя',
            'address' => 'Адрес',
            'company' => 'Место работы',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'old_password' => 'Текущий пароль',
            'new_password' => 'Новый пароль',
            'password_verify' => 'Подтвердите пароль',
            'password_again' => 'Подтвердите пароль',
        ];

        $validation_result = Validator::validate($data, $rules, $naming);

        $validation_result->customErrors([
            'required' => 'Поле :attribute обязательно для заполнения',
            'email' => 'Поле :attribute не коректно',
            'name.alpha' => 'Поле :attribute должно содежать буквы',
            'min_length' => 'Поле :attribute должно содержать минимум :params(0) символа',
            'max_length' => 'Поле :attribute не должно превышать :params(0) символов',
            'integer'    => 'Поле :attribute должно состоять из цифр',
            'alpha_numeric' => 'Поле :attribute должно содержать и буквы и цифры',
            'equals' => 'Поле :attribute и :params(0) не совпадают'
        ]);

        if ($validation_result->isSuccess() == true) {
            return true;
        } else {
            return $validation_result->getErrors();
        }
    }

}