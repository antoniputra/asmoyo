<?php

return array(
	
	/**
	* Model Setting
	*/
	'model'		=> array(

		'user'		=> 'Antoniputra\Asmoyo\Users\User',

		// ...

	),

	/**
	* Admin Setting
	*/
	'admin'		=> array(
		
		/**
		 * Url prefix to admin page
		 */
		'prefix'	=> 'panel'
	),

	/**
	* Uploads path settings
	*/
	'uploads'		=> array(

		/**
		* where base upload path should be stored
		*/
		'path'			=> public_path('uploads/'),

		/**
		* where image upload path should be stored
		*/
		'path_image'	=> public_path('uploads/images/'),

		/**
		* where audio upload path should be stored
		*/
		'path_audio'	=> public_path('uploads/audio/'),

		/**
		* where video upload path should be stored
		*/
		'path_video'	=> public_path('uploads/video/'),

	),

);