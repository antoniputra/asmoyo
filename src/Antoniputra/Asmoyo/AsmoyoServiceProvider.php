<?php namespace Antoniputra\Asmoyo;

use Illuminate\Support\ServiceProvider;
use Config;

class AsmoyoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('antoniputra/asmoyo');

		$this->app->register('Intervention\Image\ImageServiceProvider');

		// set Auth model
		Config::set('auth.model', Config::get('asmoyo::model.user'));
	
		include __DIR__ . '/../../functions.php';
		include __DIR__ . '/../../filters.php';
		include __DIR__ . '/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('asmoyo.option', function(){
			return new \Antoniputra\Asmoyo\Options\OptionRepo(
				new \Antoniputra\Asmoyo\Options\Option
			);
		});

		// get base option
		$this->app->bindShared('asmoyo.option.base', function($app)
		{
			return $app['asmoyo.option']->getBase();
		});

		// get widget lists
		$this->app->bindShared('asmoyo.option.widget', function($app)
		{
			return $app['asmoyo.option']->getWidget();
		});

		/**
		 * Binding Category
		 */
		$this->app->bind('asmoyo.category', function($app)
		{
			return new \Antoniputra\Asmoyo\Categories\CategoryRepo(
				new \Antoniputra\Asmoyo\Categories\Category
			);
		});

		/**
		 * Binding Media
		 */
		$this->app->bind('asmoyo.media', function($app)
		{
			return new \Antoniputra\Asmoyo\Posts\Medias\MediaRepo(
				new \Antoniputra\Asmoyo\Posts\Medias\Media
			);
		});

		/**
		 * Binding Page
		 */
		$this->app->bind('asmoyo.page', function($app)
		{
			return new \Antoniputra\Asmoyo\Posts\Pages\PageRepo(
				new \Antoniputra\Asmoyo\Posts\Pages\Page
			);
		});

		/**
		 * Binding Blog
		 */
		$this->app->bind('asmoyo.blog', function($app)
		{
			return new \Antoniputra\Asmoyo\Posts\Blogs\BlogRepo(
				new \Antoniputra\Asmoyo\Posts\Blogs\Blog
			);
		});

		/**
		 * Binding Widget
		 */
		$this->app->bindShared('asmoyo.widget', function($app)
		{
			return new \Antoniputra\Asmoyo\Widgets\Wg(
				new \Antoniputra\Asmoyo\Widgets\WgCategoryRepo(
					new \Antoniputra\Asmoyo\Widgets\WgCategory
				),
				new \Antoniputra\Asmoyo\Widgets\WgItemRepo(
					new \Antoniputra\Asmoyo\Widgets\WgItem
				)
			);
		});

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
