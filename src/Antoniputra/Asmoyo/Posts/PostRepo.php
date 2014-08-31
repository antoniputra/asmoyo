<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PostRepo extends Repository
{
	/**
	 * contain fillable fields
	 */
	protected $fillable;

	/**
	 * type from post (post, page, media)
	 */
	protected $type;

	public function __construct(Post $model)
	{
		$this->model = $model;
	}

	/**
	 * Override from parent
	 * get fillable from repo by type
	 * @return Input
	 */
	public function getInputOnlyFillable()
	{
		return Input::only( $this->fillable );
	}
}