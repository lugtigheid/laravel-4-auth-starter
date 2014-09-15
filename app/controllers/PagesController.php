<?php

class PagesController extends \BaseController {

	public function getHome()
	{
		return View::make('pages.home')->with($this->layouts);
	}

	public function getAbout()
	{
		return View::make('pages.about')->with($this->layouts);
	}

	public function getContact()
	{
		return View::make('pages.contact')->with($this->layouts);
	}

}