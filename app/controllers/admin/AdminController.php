<?php

class AdminController extends \BaseController {

	public function getHome()
	{
		return View::make('protected.admin.admin_dashboard');
	}
	
}