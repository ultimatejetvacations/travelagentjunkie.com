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
        // Entities
        $this->app->bind('App\Entities\Contracts\IQuote', 'App\Entities\Quote');
        $this->app->bind('App\Entities\Contracts\IQuoteOption', 'App\Entities\QuoteOption');

        // Repositories
        $this->app->bind('App\Repositories\Contracts\IQuoteRepository', 'App\Repositories\QuoteRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteOptionRepository', 'App\Repositories\QuoteOptionRepository');
	}

}
