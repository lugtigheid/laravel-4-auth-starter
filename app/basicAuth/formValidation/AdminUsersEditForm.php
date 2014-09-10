<?php namespace basicAuth\formValidation;

use Laracasts\Validation\FormValidator;

class AdminUsersEditForm extends FormValidator {

    protected $rules =
    [
        'account_type' => 'integer|between:1,2',
        'email' => 'required|email|unique:users',
        'first_name' => 'required',
        'last_name' => 'required',
        'password' => 'confirmed|min:6',
    ];

    public function excludeUserId($id)
    {
        $this->rules['email'] = "required|email|unique:users,email,$id";
        return $this;
    }

}