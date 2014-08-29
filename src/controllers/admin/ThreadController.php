<?php

use Antoniputra\Asmoyo\Posts\PostRepo;

class Admin_ThreadController extends AsmoyoController {

	public function __construct(PostRepo $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 * GET /post
	 *
	 * @return Response
	 */
	public function index()
	{
		Antoniputra\Asmoyo\Categories\Category::with('posts')->find(1);
		// Antoniputra\Asmoyo\Tags\Tag::with('posts')->find(1);
		return 'adf';
		// return $this->model->getModel()->with('category', 'tags')->find(1);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /post/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /post
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /post/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /post/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /post/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /post/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}