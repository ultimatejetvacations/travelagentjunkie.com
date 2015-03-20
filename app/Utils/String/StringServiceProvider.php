<?php namespace App\Utils\String;

use Illuminate\Support\ServiceProvider;

class StringServiceProvider extends ServiceProvider {

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('utils.string', function(){
            return new StringBuilder;
        });
	}

}
