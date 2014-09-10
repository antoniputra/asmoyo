<?php

class AssetController extends Controller
{
	/**
	 * Path image will be stored
	 * @var string
	 */
	protected $path;

	/**
	 * Path image thumb will be stored
	 * @var string
	 */
	protected $path_thumb;

	/**
	 * Default image
	 * @var string
	 */
	protected $default_image;

	public function __construct()
	{
		$this->path = str_finish(Config::get('asmoyo::uploads.path_image'), '/');
		$this->path_thumb 		= str_finish($this->path, '/') .'thumb/';
		$this->default_image 	= asmoyo_option('media_imageDefault');
	}

	/**
	 * Get Image
	 * @param string filename
	 * @return Response Image
	 */
	public function getImage($filename)
	{
		$image 	= $this->path . $filename;
		$etag 	= $this->makeEtag($image);

		// if cannot get etag, response image default
		if ( ! $etag ) return $this->getDefaultImage($this->path);

		// if etag valid, return as 304 not modified
		if ( $this->isValid($etag) ) {
			return $this->setNotModified();
		}

		// Response image and then set etag by filemtime
		return $this->setImageResponse($image, $etag);
	}

	/**
	 * Get Thumbnail
	 * @param string filename
	 * @return Response Image
	 */
	public function getThumb($filename)
	{
		$image 	= $this->path_thumb . $filename;
		$etag 	= $this->makeEtag($image);

		// if cannot get etag, response image default
		if ( ! $etag ) return $this->getDefaultImage($this->path);

		// if etag valid, return as 304 not modified
		if ( $this->isValid($etag) ) {
			return $this->setNotModified();
		}

		return $this->setImageResponse($image, $etag);
	}

	/**
	 * Generate etag key by filemtime
	 * @param string 	path_to_image
	 * @return mix : string|false
	 */
	private function makeEtag($path_image)
	{
		return ( is_file($path_image) ) ? md5( filemtime($path_image) ) : false ;
	}

	/**
	 * check etag
	 * @return boolean
	 */
	private function isValid($entity)
	{
		$etag 	= str_replace('"', '', Request::getEtags() );

		if ( isset($etag[0]) )
		{
			if ( $etag[0] === $entity )
	    	{
		        return true;
	    	}

	    	// etag gzip
	    	$etag_gzip = $entity.'-gzip';
	    	if( $etag_gzip === $etag[0] )
	    	{
	    		return true;
	    	}
    	}

    	return false;
	}

	/**
	 * Set response 304 not modified
	 * @return Response
	 */
	private function setNotModified()
	{
		$response = new Symfony\Component\HttpFoundation\Response;
		return $response->setStatusCode(304, 'This file is not Modified');
	}

	private function setImageResponse($image, $etag = null)
	{
		$resp = Response::make(File::get($image), 200, array(
			'Content-Type' => getMime(File::extension($image))
		));
		$resp->setCache(array(
			'max_age' 		=> 86400, // One day
			'public' 		=> true,   // Allow public caches to cache
		));
		
		if ($etag) {
			$resp->setEtag($etag);
		}
		return $resp;
	}

	/**
	 * Get default image
	 * @return Response
	 */
	public function getDefaultImage($path)
	{
		// $imgDefault = $path . $this->default_image;
		$imgDefault = public_path('/packages/antoniputra/asmoyo/_img/'). $this->default_image;
		$etag 		= $this->makeEtag($imgDefault);
		return $this->setImageResponse($imgDefault);
	}
}