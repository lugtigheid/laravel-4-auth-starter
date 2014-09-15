<?php

use basicAuth\Repo\UserRepositoryInterface;
use basicAuth\formValidation\UsersEditForm;

class UsersController extends \BaseController {

	protected $user;
	protected $usersEditForm;

	function __construct(UserRepositoryInterface $user, UsersEditForm $usersEditForm)
	{
		parent::__construct();

		$this->user = $user;
		$this->usersEditForm = $usersEditForm;

		$this->beforeFilter('currentUser', ['only' => ['show', 'edit', 'update']]);
	}

	public function show($id)
	{
		// $user = User::findOrFail($id);
		$user = $this->user->find($id);

		return View::make('protected.standardUser.show')->withUser($user);

	}

	public function edit($id)
	{
		// $user = User::findOrFail($id);
		$user = $this->user->find($id);

		return View::make('protected.standardUser.edit')->withUser($user);
	}

	public function update($id)
	{
		// $user = User::findOrFail($id);
		$user = $this->user->find($id);

		if (! Input::has("password"))
		{
			$input = Input::only('email', 'first_name', 'last_name');
			$this->usersEditForm->excludeUserId($user->id)->validate($input);
			$user->fill($input)->save();
			return Redirect::route('profiles.edit', $user->id)->withFlashMessage('User has been updated successfully!');
		}
		else
		{
			$input = Input::only('email', 'first_name', 'last_name', 'password', 'password_confirmation');
			$this->usersEditForm->excludeUserId($user->id)->validate($input);
			$input = array_except($input, ['password_confirmation']);
			$user->fill($input)->save();
			$user->save();
			return Redirect::route('profiles.edit', $user->id)->withFlashMessage('User (and password) has been updated successfully!');
		}
	}

}