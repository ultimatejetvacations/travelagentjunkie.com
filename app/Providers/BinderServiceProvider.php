<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BinderServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application bindings.
	 *
	 * @return void
	 */
	public function register()
	{
        // Repositories
        $this->app->bind('App\Repositories\Contracts\IQuoteRepository', 'App\Repositories\QuoteRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteOptionRepository', 'App\Repositories\QuoteOptionRepository');
	}

}
