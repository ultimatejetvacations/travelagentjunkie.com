<?php namespace App\Entities;

class QuoteOptionHotelRoomPhoto extends BaseEntity {

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

    /**
     * Return the actual room photo record
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roomPhoto()
    {
        return $this->hasOne('App\Entities\RoomPhoto', 'id_room_categories_photo', 'id_room_categories_photo');
    }

}
