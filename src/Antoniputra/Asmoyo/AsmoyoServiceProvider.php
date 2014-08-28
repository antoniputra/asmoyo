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

		// set Auth model
		Config::set('auth.model', Config::get('asmoyo::model.user'));

		if( \Schema::hasTable('options') ) {
			include __DIR__ . '/../../functions.php';
		}

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
		$this->app->bind('Asmoyo\Options\OptionInterface', function(){
			return new \Antoniputra\Asmoyo\Options\OptionRepo(
				new \Antoniputra\Asmoyo\Options\Option
			);
		});

		/**
		 * get all option
		 */
		$this->app->bindShared('asmoyo.option', function($app)
		{
			return $app['Asmoyo\Options\OptionInterface']->get();
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
