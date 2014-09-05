<?php namespace Antoniputra\Asmoyo\Posts\Pages;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PageRepo extends Repository
{
	protected $validationEditRules = [
        'title'     => 'required',
        'slug'      => 'required',
    ];

    protected $repo_type 	= 'page';
    protected $repo_fields 	= ['id', 'user_id', 'parent_id', 'image', 'images', 'status', 'comment_status', 'type', 'order', 'mime_type', 'size', 'options', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description', 'created_at', 'updated_at', 'deleted_at'];

	public function __construct(Page $model)
	{
		$this->model = $model;
	}

	/**
	 * get parent page
	 * @param forgetId integer
	 */
	public function getParent($forgetId = null)
	{
		$parent = $this->queryRepo()->where('parent_id', 0);

		if($forgetId) {
			$parent = $parent->where('id', '!=', $forgetId);
		}

		return $parent->get()->toArray();
	}

}