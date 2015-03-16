<?php namespace App\Entities;

use App\Entities\Contracts\IQuoteOptionAirline;

class QuoteOptionAirline extends BaseEntity implements IQuoteOptionAirline {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options_airlines';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'quote_airline_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public  function airfares()
    {
        return $this->hasMany('App\Entities\QuoteOptionAirlineAirfare', 'quote_airline_id', 'quote_airline_id');
    }

}
