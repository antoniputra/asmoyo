<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class CategoryRepo extends Repository {
	
	protected $validationEditRules = [
        'title'     => 'required|unique:categories,title,{id}',
        'slug'      => 'required|unique:categories,slug,{id}',
    ];

    protected $repo_type 	= 'category';

	public function __construct(Category $model)
	{
		$this->model = $model;
	}

	/**
	 * get parent category
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

	/**
	 * Get category with related blog
	 */
	public function getBySlugWithBlog($slug, $limit = null)
	{
		$key = __FUNCTION__.$slug;
		return $this->cache()->rememberForever($key, function() use($slug, $limit)
		{
			return $this->queryRepo()->with(['blogs' => function($query) use($limit)
			{
				return $query->get($limit);
			}])->where('slug', $slug)->first();
		});
	}

	/**
	 * Get category with related media
	 */
	public function getBySlugWithMedia($slug, $limit = null)
	{
		$key = __FUNCTION__.$slug;
		return $this->cache()->rememberForever($key, function() use($slug, $limit)
		{
			return $this->queryRepo()->with(['medias' => function($query) use($limit)
			{
				return $query->get($limit);
			}])->where('slug', $slug)->first();
		});
	}

}