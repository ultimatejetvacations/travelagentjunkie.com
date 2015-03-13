<?php namespace App\Entities;

use App\Entities\Contracts\IQuoteOptionHotelRoom;

class QuoteOptionHotelRoom extends BaseEntity implements IQuoteOptionHotelRoom {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options_hotel_rooms';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'quote_option_room_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
