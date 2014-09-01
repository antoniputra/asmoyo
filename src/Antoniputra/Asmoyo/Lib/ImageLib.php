<?php namespace Antoniputra\Asmoyo\Lib;

use Input, Config, File;
use Intervention\Image\ImageManagerStatic as InterventionImage;

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
	 * set filename
	 */
	protected $fileName;

	/**
	 * Path image will be stored
	 */
	protected $path;

	/**
	 * Path image thumb will be stored
	 */
	protected $path_thumb;

	/**
	 * with thumbnail
	 */
	protected $thumbSize;

	/**
	 * Contain result finished file upload
	 */
	protected $result;

	/**
	 * Contain errors message
	 */
	protected $errors = 'something went wrong when upload process, be sure the extension is jpg, jpeg, png, gif';

	public function __construct($file, $fileName = null)
	{
		$this->file 	= $file;
		$this->fileName = $fileName;
		$this->path 	= str_finish(Config::get('asmoyo::uploads.path_image'), '/');
		$this->path_thumb = str_finish($this->path, '/') .'thumb/';
	}

	/**
	 * do single upload
	 * @return boolean
	 */
	protected function single()
	{
		if ( ! $this->file->isValid())
		    throw new \Exception("Your File is not valid", 1);

		$image = $this->fileData();

		// if thumbSize
		if ($this->thumbSize)
		{
			$this->generateThumb($image);
		}

		if ( $this->file->move($this->path, $image['fileName']) )
		{
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
		$this->checkDir();

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
	 * Set upload with generated Thumbnail by given size
	 * @return this
	 */
	public function withThumb($w = 320, $h = 320)
	{
		$this->thumbSize = array('w' => $w, 'h' => $h);
		return $this;
	}

	/**
	 * generating by thumbSize property
	 */
	protected function generateThumb($image)
	{
		$size 	= $this->thumbSize;
		$thumb 	= InterventionImage::make( $image['realPath'] )->fit($size['w']);
		return $thumb->save( $this->path_thumb . $image['fileName'] );
	}

	/**
	 * run image upload here
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
	protected function fileData($file = array())
	{
		$file 		= $file ?: $this->file;
		$fileName 	= $this->fileName ?: str_random(50) .'.'. $extension;
		$extension 	= $file->getClientOriginalExtension();
		return array(
			'mimeType'		=> $file->getMimeType(),
			'extension'		=> $extension,
			'size'			=> $file->getSize(),
			'realPath'		=> $file->getRealPath(),
			'fileName'		=> $fileName,
		);
	}

	/**
	 * check existance destination path directory
	 * if not exists, create it
	 * @param string 	path
	 * @return void
	 */
	private function checkDir()
	{
		$path = $this->path;
		if ( ! file_exists( $path ) AND ! File::makeDirectory($path, 0777, true, true) )
		{
			throw new \Exception("Error when make '$path', be sure your directory is writable", 1);
		}

		// create thumb directory
		$path_thumb = $this->path_thumb;
		if ( ! file_exists( $path_thumb ) AND ! File::makeDirectory($path_thumb, 0777, true, true) )
		{
			throw new \Exception("Error when make '$path_thumb', be sure your directory is writable", 1);
		}
	}


	public function getPathFile()
	{
		return $this->path . $this->file;
	}

	public function getPathThumbFile()
	{
		return $this->path_thumb . $this->file;
	}
}