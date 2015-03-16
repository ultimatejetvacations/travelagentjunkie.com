<?php namespace App\Entities;

use App\Entities\Contracts\IAirline;

class Airline extends BaseEntity implements IAirline {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'airlines';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'airline_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
