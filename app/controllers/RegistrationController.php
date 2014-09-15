<?php

use basicAuth\Repo\UserRepositoryInterface;
use basicAuth\formValidation\RegistrationForm;

class RegistrationController extends \BaseController {

	protected $user;
	private $registrationForm;

	function __construct(UserRepositoryInterface $user, RegistrationForm $registrationForm)
	{
		parent::__construct();
		
		$this->user = $user;
		$this->registrationForm = $registrationForm;
	}

	public function create()
	{
		return View::make('registration.create');
	}

	public function store()
	{
		$input = Input::only('email', 'password', 'password_confirmation', 'first_name', 'last_name');
		$this->registrationForm->validate($input);
		$input = Input::only('email', 'password', 'first_name', 'last_name');
		$input = array_add($input, 'activated', true);
		$user = $this->user->create($input);

		// Find the group using the group name
    	$usersGroup = Sentry::findGroupByName('Users');

    	// Assign the group to the user
    	$user->addGroup($usersGroup);

		return Redirect::to('login')->withFlashMessage('User Successfully Created!');
	}

}