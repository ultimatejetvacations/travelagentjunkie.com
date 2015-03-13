<?php namespace App\Entities;

use App\Entities\Contracts\IQuoteOptionHotelRoomPhoto;

class QuoteOptionHotelRoomPhoto extends BaseEntity implements IQuoteOptionHotelRoomPhoto {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options_hotel_room_photos';

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

    /**
     * Return the actual hotel photo record
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotelPhoto()
    {
        return $this->hasOne('App\Entities\HotelPhoto', 'id_hotel_photo', 'id_hotel_photo');
    }

}
