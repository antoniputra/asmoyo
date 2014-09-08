<?php

class OptionsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('options')->truncate();
		
		$options = [
			// Web
			[
				'name'			=> 'web_title',
				'description'	=> 'Your website title',
				'value'			=> 'My Website',
				'type'			=> '',
			],
			[
				'name'			=> 'web_description',
				'description'	=> 'Your website description',
				'value'			=> 'My Awesome Website',
				'type'			=> '',
			],
			[
				'name'			=> 'web_email',
				'description'	=> 'Your website email, for email system',
				'value'			=> 'name@gmail.com',
				'type'			=> '',
			],
			[
				'name'			=> 'web_logo',
				'description'	=> 'Your website logo',
				'value'			=> 'logo.png',
				'type'			=> '',
			],
			[
				'name'			=> 'web_location',
				'description'	=> 'Your website google maps location',
				'value'			=> '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d494.74453749257185!2d112.73792683505405!3d-7.245813755163173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x17880de8f5b6c07f!2sMonumen+Tugu+Pahlawan!5e0!3m2!1sen!2sid!4v1409005409994" width="600" height="450" frameborder="0" style="border:0"></iframe>',
				'type'			=> '',
			],
			[
				'name'			=> 'web_address',
				'description'	=> 'Your website address text',
				'value'			=> 'Indonesia, Surabaya, Simo Gunung Barat Tol',
				'type'			=> '',
			],
			[
				'name'			=> 'web_contact',
				'description'	=> 'Your website contact',
				'value'			=> json_encode([
					'name' 	=> 'Customer Service',
					'value' => '+6285649787899',
				]),
				'type'			=> 'json',
			],
			[
				'name'			=> 'web_facebook',
				'description'	=> 'Your website facebook url',
				'value'			=> json_encode([
					'url'	=> 'http://www.facebook.com'
				]),
				'type'			=> 'json',
			],
			[
				'name'			=> 'web_twitter',
				'description'	=> 'Your website twitter url',
				'value'			=> json_encode([
					'url'	=> 'http://www.twitter.com'
				]),
				'type'			=> 'json',
			],
			[
				'name'			=> 'web_owner',
				'description'	=> 'Owner of this website',
				'value'			=> json_encode([
					'name'	=> 'John Doe',
					'email'	=> 'john@gmail.com',
					'description' => 'Web Developer at Surabaya, Simo'
				]),
				'type'			=> 'json',
			],
			[
				'name'			=> 'web_metaTitle',
				'description'	=> 'your website meta title',
				'value'			=> 'My Awesome Website',
				'type'			=> '',
			],
			[
				'name'			=> 'web_metaKeyword',
				'description'	=> 'your website meta keyword',
				'value'			=> 'My Awesome Company Website',
				'type'			=> '',
			],
			[
				'name'			=> 'web_metaDescription',
				'description'	=> 'your website meta description',
				'value'			=> 'My Awesome Company Website who services Event Organizer, MC, and other...',
				'type'			=> '',
			],

			[
				'name'			=> 'web_theme',
				'description'	=> 'Theme for this website',
				'value'			=> json_encode([
					'name'	=> 'standard',
					'title'	=> 'Asmoyo Standard Theme',
					'description' => 'This is Standard Theme starter for using this framework',
				]),
				'type'			=> 'json',
			],
			// End Web

			
			// Media
			[
				'name'			=> 'media_imageWatermark',
				'description'	=> 'your media image watermark ?',
				'value'			=> 'watermark.jpg',
				'type'			=> '',
			],
			[
				'name'			=> 'media_imageThumbnail',
				'description'	=> 'your media image thumbnail size',
				'value'			=> json_encode([
					'width' => '300px',
					'height' => '300px',
				]),
				'type'			=> 'json',
			],
			[
				'name'			=> 'media_imageDefault',
				'description'	=> 'Image Default. when some resource haven\'t image, this will be used',
				'value'			=> 'default.jpg',
				'type'			=> '',
			],
			// End Media


			// Widget
			[
				'name'			=> 'widget_bootstrap-carousel',
				'description'	=> 'This is banner using bootstrap-carousel.js',
				'value'			=> json_encode([
					'title'	=> 'Bootstrap Carousel',
					'fields' => ['category_id', 'image', 'title', 'description']
				]),
				'type'			=> 'json',
			]
			// End Widget
		];

		DB::table('options')->insert($options);
	}
}