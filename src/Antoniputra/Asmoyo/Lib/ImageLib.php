<?php namespace Antoniputra\Asmoyo\Lib;

use Input, Config, File;

/**
* 
*/
class ImageLib
{
	/**
	 * Contain File
	 * @var Class \Input
	 */
	protected $file;

	/**
	 * Path image will be stored
	 */
	protected $path;

	/**
	 * Contain result finished file upload
	 */
	protected $result;

	/**
	 * Contain errors message
	 */
	protected $errors;

	public function __construct($file)
	{
		$this->file = $file;
		$this->path = str_finish(Config::get('asmoyo::uploads.path_image'), '/');
	}

	/**
	 * do single upload
	 * @return boolean
	 */
	protected function single()
	{
		if ( ! $this->file->isValid())
		    throw new Exception("Your File is not valid", 1);

		$image = $this->fileParam();

		if ( $this->file->move($this->path, $image['fileName']) ) {
			$this->result = $image;
			return true;
		}
		return false;
	}

	protected function multiple()
	{
		// logic for multiple uploads
	}

	public function doUpload()
	{
		// check directory
		$this->checkDir($this->path);

		// if the given file is multiple
		if ( is_array($this->file) )
		{
			return $this->multiple();
		}

		// if the given file is single
		else
		{
			return $this->single();
		}
	}

	/**
	 * start from here
	 * @return boolean
	 */
	public function run()
	{
		if ( $this->doUpload() ) {
			return $this->getResult();
		}
		return false;
	}

	public function getResult()
	{
		return $this->result;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * file parameters
	 * used for result
	 * @return array
	 */
	protected function fileParam($file = array())
	{
		$file 		= $file ?: $this->file;
		$extension 	= $file->getClientOriginalExtension();
		return array(
			'mimeType'		=> $file->getMimeType(),
			'extension'		=> $extension,
			'size'			=> $file->getSize(),
			'realPath'		=> $file->getRealPath(),
			'fileName'		=> str_random(50) .'.'. $extension,
		);
	}

	/**
	 * check existance destination path directory
	 * if not exists, create it
	 * @param string 	path
	 * @return void
	 */
	private function checkDir($path)
	{
		if ( ! file_exists( $path )) {
			if ( ! File::makeDirectory($path, 0777, true, true) ) {
				throw new \Exception("Error when make directory, be sure your directory is writable", 1);
			}
		}
	}
}