<?php namespace App\Entities;

use App\Entities\Contracts\IQuoteOptionAirlineAirfare;

class QuoteOptionAirlineAirfare extends BaseEntity implements IQuoteOptionAirlineAirfare {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options_airfare';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'flight_route_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function airline()
    {
        return $this->hasOne('App\Entities\Airline', 'airline_id', 'airline_id');
    }

}
