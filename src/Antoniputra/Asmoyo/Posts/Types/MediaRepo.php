<?php namespace Antoniputra\Asmoyo\Posts\Types;

/* NOTE : STATUS FOR MEDIA IS PUBLISH (can be accessed as page) AND VISIBLE just image */

use Antoniputra\Asmoyo\Posts\PostRepo;
use Input;

class MediaRepo extends PostRepo
{
	protected $fillable = ['user_id', 'category_id', 'status', 'comment_status', 'type', 'mime_type', 'size', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description'];

	protected $type = 'media';

    public $statusList = ['publish', 'visible', 'private'];
}