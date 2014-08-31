<?php namespace Antoniputra\Asmoyo\Posts\Medias;

/* NOTE : STATUS FOR MEDIA IS PUBLISH (can be accessed as page) AND VISIBLE just image */

use Antoniputra\Asmoyo\Cores\Repository;
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
}