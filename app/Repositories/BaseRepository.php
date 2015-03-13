<?php namespace App\Repositories;

use App\Repositories\Contracts\IBaseRepository;

abstract class BaseRepository implements IBaseRepository {

    /**
     * Private construct in order to make the class uninstantiable.
     */
    private function __constrcut() { }

    /**
     * Get the Repository Entity
     *
     * @return mixed
     */
    abstract function getEntity();

}