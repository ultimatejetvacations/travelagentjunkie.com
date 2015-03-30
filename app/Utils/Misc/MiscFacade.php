<?php namespace App\Utils\Misc;

use Illuminate\Support\Facades\Facade;

class MiscFacade extends Facade {

/**
* Get the registered name of the component.
*
* @return string
*/
protected static function getFacadeAccessor() { return 'utils.misc'; }

}