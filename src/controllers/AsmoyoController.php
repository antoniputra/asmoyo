<?php

/**
* 
*/
abstract class AsmoyoController extends Controller
{
	public function adminView($content, $data = array(), $pseudo=true)
	{
		$web = app('asmoyo.option');
		$base 	= 'asmoyo::.'. $web['web_adminTemplate']['name'] .'.';
		return $base;
		if ( ! $this->structure )
		{
			$this->structure = $base .'twoCollumn';
		}
		$content = $base . $content;
		
		$output = View::make($this->structure, $data)
					->nest('content', $content, $data)
					->render();

		return $output;
	}

	/**
	 * Redirect with alert
	 */
	protected function redirectAlert($to=null, $alertType='info', $alertTitle=null, $alertText=null)
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