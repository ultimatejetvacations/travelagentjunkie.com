<?php namespace App\Entities;

use App\Entities\Contracts\IQuoteOptionHotelRoomExtraPerson;

class QuoteOptionHotelRoomExtraPerson extends BaseEntity implements IQuoteOptionHotelRoomExtraPerson {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options_hotel_room_extra_persons';

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
