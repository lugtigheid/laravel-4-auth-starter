<?php

class StandardUserController extends \BaseController {

	public function getHome()
	{
		return View::make('protected.standardUser.user_dashboard');
	}

	public function getUserProtected()
	{
		return View::make('protected.standardUser.user_page_1');
	}
	
}