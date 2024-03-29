<?php namespace App\Utils\String;

use Illuminate\Support\Facades\Facade;

class StringFacade extends Facade {

/**
* Get the registered name of the component.
*
* @return string
*/
protected static function getFacadeAccessor() { return 'utils.string'; }

}