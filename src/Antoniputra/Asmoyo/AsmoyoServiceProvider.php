<?php namespace Antoniputra\Asmoyo;

use Illuminate\Support\ServiceProvider;

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

		include __DIR__ . '/../../function.php';
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
		// get website current option
		$this->app->bindShared('Asmoyo\Option', function()
		{
			return new \Antoniputra\Asmoyo\Options\OptionRepo(
				new \Antoniputra\Asmoyo\Options\Option
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
