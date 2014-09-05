<?php namespace Antoniputra\Asmoyo\Posts\Medias;

/* NOTE : STATUS FOR MEDIA IS PUBLISH (can be accessed as page) AND VISIBLE just image */

use Antoniputra\Asmoyo\Cores\Repository;
use Antoniputra\Asmoyo\Lib\ImageLib;
use Input;

class MediaRepo extends Repository
{
	protected $validationEditRules = [
        'title'     => 'required',
        'slug'      => 'required',
    ];

    protected $repo_type 	= 'media';
    protected $repo_fields 	= ['id', 'user_id', 'category_id', 'status', 'comment_status', 'type', 'mime_type', 'size', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description', 'created_at', 'updated_at', 'deleted_at'];

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
		if ( ! $newData->isValid() ) {
			return false;
		}

		if (Input::hasFile('content')) {
			$file 		= $newData->content;
			$imageLib 	= new ImageLib($file, Input::get('content', null));
			if( ! $imageLib->withThumb()->run() ) {
				$newData->setErrors( $imageLib->getErrors() );
				return false;
			}
			$newData = $this->fillUploadField( $newData, $imageLib->getResult() );
		}

		return parent::save($newData, $newValidation);
	}

	public function delete($model, $is_permanent = false)
	{
		// unlink/delete image
		$imageLib 	= new ImageLib($model->content);
		\File::delete( $imageLib->getPathFile(), $imageLib->getPathThumbFile() );
		return parent::delete($model, $is_permanent);
	}

	/**
	 * fill upload data
	 * @param Model 	newData
	 * @param image 	array
	 * @return Model
	 */
	private function fillUploadField($newData, $image)
	{
		$newData->mime_type = $image['mimeType'];
		$newData->size 		= $image['size'];
		$newData->content 	= $image['fileName'];
		return $newData;
	}
}