<?php

class BaseController extends Controller {

	protected $layoutsOpt = array();

	public function __construct()
    {
        $this->beforeFilter(function(){
            $this->layoutsOpt['masterLayout']  = 'layouts.frontend.master';
			$this->layoutsOpt['adminLayout']   = 'layouts.backend.admin';
			$this->layoutsOpt['missingLayout'] = 'layouts.frontend.master';
        });
    }

	protected function setupLayout()
	{
		View::share($this->layoutsOpt);
		if ( ! is_null($this->layout)) $this->layout = View::make($this->layout);
	}

}