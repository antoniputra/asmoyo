<?php namespace Antoniputra\Asmoyo\Posts\Blogs;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class BlogRepo extends Repository
{
	protected $validationEditRules = [
        'title'     => 'required',
        'slug'      => 'required',
    ];

    protected $repo_type 	= 'blog';
    protected $repo_fields 	= ['id', 'user_id', 'category_id', 'image', 'images', 'status', 'comment_status', 'type', 'mime_type', 'options', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description'];

	public function __construct(Blog $model)
	{
		$this->model = $model;
	}

}