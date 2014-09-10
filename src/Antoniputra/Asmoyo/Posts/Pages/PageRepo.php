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
		$parent = $this->setRepoFields(['id', 'parent_id', 'status', 'type', 'order', 'title', 'slug'])
			->queryRepo()
			->where('parent_id', 0)
			->orderBy('order', 'asc');

		if($forgetId) {
			$parent = $parent->where('id', '!=', $forgetId);
		}

		return $parent->get()->toArray();
	}

	public function getChild($parent_id)
	{
		return $this->setRepoFields(['id', 'parent_id', 'status', 'type', 'order', 'title', 'slug'])
			->queryRepo()
			->where('parent_id', $parent_id)
			->orderBy('order', 'asc')
			->get()->toArray();
	}

	/**
	 * get as menu
	 * with 1 level dropdown
	 */
	public function getAsMenu()
	{
		$key = $this->getCacheKey(__FUNCTION__);
        return $this->cache()->rememberForever($key, function()
        {
			$result = [];
			$parent = $this->getParent();
			if ($parent) {
				foreach ($parent as $p) {
					$menu = $p;
					$menu['url'] 	= route('page.show', $p['slug']);
					$menu['child'] 	= [];

					$child = $this->getChild($p['id']);
					if ($child) {
						foreach ($child as $c) {
							$menuChild 	= $c;
							$menuChild['url'] = route('page.show', $c['slug']);
							$menu['child'][] = $menuChild;
						}
					}

					$result[] = $menu;
				}
			}
			return $result;
		});
	}

}