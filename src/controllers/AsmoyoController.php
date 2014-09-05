<?php

abstract class AsmoyoController extends Controller
{
	/**
	 * layout template name
	 */
	protected $layout = 'layout';

	/**
	 * collumn template name
	 * the name should follow naming convention e.g : one_collumn, two_collumn
	 */
	protected $collumn = 'two_collumn';

	public function publicView($content, $data = [])
	{
		$this->publicViewShare();

		$_path 		= 'asmoyo-theme.baretshow.';
		$layout 	= $_path . $this->layout;
		$collumn 	= $_path . $this->collumn;
		$content 	= $_path . $content;

    	return View::make($collumn, $data)
			->nest('content', $content, $data);
	}

	public function adminView($content, $data = [])
	{
		$this->adminViewShare();

		$_path 		= 'asmoyo::admin.';
		$layout 	= $_path . $this->layout;
		$collumn 	= $_path . $this->collumn;
		$content 	= $_path . $content;

    	return View::make($collumn, $data)
			->nest('content', $content, $data);
	}

	
	/**
	 * set collumn for body
	 * @param $collum  should naming convention : (one_collumn, two_collumn)
	 */
	protected function setLayout($layout = 'layout')
	{
		$this->layout = $layout;
		return $this;
	}

	
	/**
	 * set collumn for body
	 * @param $collum  should naming convention : (one_collumn, two_collumn)
	 */
	protected function setCollumn($collumn = 'two_collumn')
	{
		$this->collumn = $collumn;
		return $this;
	}


	/**
	 * determine global variable for public view
	 */
	protected function publicViewShare()
	{
		$auth = Auth::user();

		$_path 		= 'asmoyo-theme.baretshow.';
		$layout 	= $_path . $this->layout;
		$collumn 	= $_path . $this->collumn;
        
        View::share(array(
        	'auth' 			=> $auth,
        	'theme_path'	=> $_path,
        	'layout'		=> $layout,
        	'collumn'		=> $collumn,
    	));
	}

	/**
	 * determine global variable for admin view
	 */
	protected function adminViewShare()
	{
		$auth = Auth::user();

		$_path 		= 'asmoyo::admin.';
		$layout 	= $_path . $this->layout;
		$collumn 	= $_path . $this->collumn;
        
        View::share(array(
        	'auth' 			=> $auth,
        	'activePage' 	=> Request::segment(2),

        	'theme_path'	=> $_path,
        	'layout'		=> $layout,
        	'collumn'		=> $collumn,
    	));
	}


	/**
	 * Redirect with alert
	 */
	protected function redirectWithAlert($to=null, $alertType='info', $alertTitle=null, $alertText=null)
	{
		if(filter_var($to, FILTER_VALIDATE_URL))
		{
			$redirect = Redirect::to($to);
		}
		elseif($to)
		{
			$redirect = Redirect::route($to);
		}
		else
		{
			$redirect = Redirect::back();
		}

		// if null, do redirect back and add withInput
		if( !$to )
		{
			return $redirect->with('alert', array(
				'type'		=> $alertType,
				'title'		=> $alertTitle,
				'text'		=> $alertText
			))->withInput();
		}
		// if redUrl, that mean do Redirect::route and add alert
		elseif( !is_null($alertTitle) )
		{
			return $redirect->with('alert', array(
				'type'		=> $alertType,
				'title'		=> $alertTitle,
				'text'		=> $alertText
			));
		}

		// if nothing alert just do Redirect::route
		return $redirect;
	}
}