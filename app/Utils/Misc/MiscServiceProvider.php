<?php namespace App\Utils\Misc;

use Illuminate\Support\ServiceProvider;

class MiscServiceProvider extends ServiceProvider {

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('utils.misc', function(){
            return new Misc();
        });
	}

}
