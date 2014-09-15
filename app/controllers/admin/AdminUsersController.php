<?php

use basicAuth\Repo\UserRepositoryInterface;
use basicAuth\formValidation\AdminUsersEditForm;

class AdminUsersController extends \BaseController {

	protected $user;
	protected $adminUsersEditForm;

	function __construct(UserRepositoryInterface $user, AdminUsersEditForm $adminUsersEditForm)
	{
		parent::__construct();
		
		$this->user = $user;
		$this->adminUsersEditForm = $adminUsersEditForm;

		//$this->beforeFilter('currentUser', ['only' => ['show', 'edit', 'update']]);
	}

	public function index()
	{
		$users = $this->user->getAll();
		$admin = Sentry::findGroupByName('Admins');
		return View::make('protected.admin.list_users')->withUsers($users)->withAdmin($admin);
	}

	public function show($id)
	{
		$user = $this->user->find($id);
		$user_group = $user->getGroups()->first()->name;
		$groups = Sentry::findAllGroups();

		return View::make('protected.admin.show_user')->withUser($user)->withUserGroup($user_group);
	}

	public function ban($id)
	{
		$throttle = Sentry::findThrottlerByUserId($id);
		$throttle->ban();

		return Redirect::route('admin.profiles.index')->withFlashMessage('User has been banned successfully!');
	}

	public function unban($id)
	{
		$throttle = Sentry::findThrottlerByUserId($id);
		$throttle->unBan();

		return Redirect::route('admin.profiles.index')->withFlashMessage('User has been unbanned successfully!');
	}

	public function edit($id)
	{
		$user = $this->user->find($id);
		$groups = Sentry::findAllGroups();
		$user_group = $user->getGroups()->first()->id;
		$array_groups = [];

		foreach ($groups as $group) {
			$array_groups = array_add($array_groups, $group->id, $group->name);
		}

		return View::make('protected.admin.edit_user', ['user' => $user, 'groups' => $array_groups, 'user_group' =>$user_group]);
	}

	public function update($id)
	{
		$user = $this->user->find($id);

		if (! Input::has("password"))
		{
			$input = Input::only('account_type' , 'email', 'first_name', 'last_name');
			$this->adminUsersEditForm->excludeUserId($user->id)->validate($input);
			$input = array_except($input, ['account_type']);
			$user->fill($input)->save();
			$this->user->updateGroup($id, Input::get('account_type'));
			return Redirect::route('admin.profiles.edit', $user->id)->withFlashMessage('User has been updated successfully!');
		}
		else
		{
			$input = Input::only('account_type', 'email', 'first_name', 'last_name', 'password', 'password_confirmation');
			$this->adminUsersEditForm->excludeUserId($user->id)->validate($input);
			$input = array_except($input, ['account_type', 'password_confirmation']);
			$user->fill($input)->save();
			$user->save();
			$this->user->updateGroup($id, Input::get('account_type'));
			return Redirect::route('admin.profiles.edit', $user->id)->withFlashMessage('User (and password) has been updated successfully!');
		}
	}

	public function destroy($id)
	{
		$user = $this->user->find($id);
		$user->delete();
		return Redirect::route('admin.profiles.index')->withFlashMessage('User has been deleted successfully!');
	}

}