<?php

use basicAuth\formValidation\ForgotPasswordForm;

class RemindersController extends Controller {

	private $forgotPasswordForm;

	function __construct(ForgotPasswordForm $forgotPasswordForm)
	{
		$this->forgotPasswordForm = $forgotPasswordForm;
	}

	public function getRemind()
	{
		return View::make('password.remind');
	}

	public function postRemind()
	{
		$this->forgotPasswordForm->validate(Input::only('email'));

		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->withErrorMessage(Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->withFlashMessage(Lang::get($response));
		}

	}

	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = $password; //Hash::make($password);
			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->withErrorMessage(Lang::get($response))->withInput();

			case Password::PASSWORD_RESET:
				return Redirect::to('login')->withFlashMessage('Password has been reset successfully!');
		}
	}

}