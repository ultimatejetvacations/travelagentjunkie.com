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
        $this->app->bind('App\Repositories\Contracts\IMemberCustomerProfileRepository', 'App\Repositories\MemberCustomerProfileRepository');
        $this->app->bind('App\Repositories\Contracts\IMemberTravelerRepository', 'App\Repositories\MemberTravelerRepository');
        $this->app->bind('App\Repositories\Contracts\IPostSaleRepository', 'App\Repositories\PostSaleRepository');
        $this->app->bind('App\Repositories\Contracts\IPostSaleTravelerRepository', 'App\Repositories\PostSaleTravelerRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteRepository', 'App\Repositories\QuoteRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteOptionRepository', 'App\Repositories\QuoteOptionRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteOptionAirlineRepository', 'App\Repositories\QuoteOptionAirlineRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteOptionHotelRoomRepository', 'App\Repositories\QuoteOptionHotelRoomRepository');
        $this->app->bind('App\Repositories\Contracts\IQuoteOptionVendorRepository', 'App\Repositories\QuoteOptionVendorRepository');
	}

}
