<?php namespace Antoniputra\Asmoyo\Posts\Medias;

/* NOTE : STATUS FOR MEDIA IS PUBLISH (can be accessed as page) AND VISIBLE just image */

use Antoniputra\Asmoyo\Cores\Repository;
use Antoniputra\Asmoyo\Lib\ImageLib;
use Input;

class MediaRepo extends Repository
{
	protected $validationEditRules = [
        'title'     => 'required|unique:posts,title,{id}',
        'slug'      => 'required|unique:posts,slug,{id}',
    ];

    protected $repo_type = 'media';

	public function __construct(Media $model)
	{
		$this->model = $model;
	}

	/**
	 * Extending save from parent
	 * @see Antoniputra\Asmoyo\Cores\Repository
	 */
	public function save($newData, $newValidation = array())
	{
		$file = $newData->content;
		$imageLib = new ImageLib($file);
		
		if( ! $imageLib->run() ) {
			return $imageLib->getErrors();
		}

		$image = $imageLib->getResult();
		$newData->mime_type = $image['mimeType'];
		$newData->size 		= $image['size'];
		$newData->content 	= $image['fileName'];

		return parent::save($newData);
	}
}