<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class CategoryRepo extends Repository
{
	protected $validationEditRules = [
        'title'     => 'required|unique:categories,title,{id}',
        'slug'      => 'required|unique:categories,slug,{id}',
    ];

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
		$parent = $this->model->where('parent_id', 0);

		if($forgetId) {
			$parent = $parent->where('id', '!=', $forgetId);
		}

		return $parent->get()->toArray();
	}

	/**
	 * 
	 */
	public function getBySlugCache($slug)
	{
		$key = __FUNCTION__.$slug;
		return $this->cache()->rememberForever($key, function() use($slug)
		{
			return $this->model->with('photo')->where('slug', $slug)->first();
		});
	}

}