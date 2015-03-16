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

    /**
     * Return the extra persons for a room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extraPersons()
    {
        return $this->hasMany('App\Entities\QuoteOptionHotelRoomExtraPerson', 'quote_option_room_id', 'quote_option_room_id');
    }

    /**
     * Return all the photo records within an room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Entities\QuoteOptionHotelRoomPhoto', 'quote_option_room_id', 'quote_option_room_id');
    }

    /**
     * Return the promotion for a room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function promotion()
    {
        return $this->hasOne('App\Entities\Promotion', 'id_promotion', 'id_promotion');
    }

    /**
     * Return the actual room for that room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function room()
    {
        return $this->hasOne('App\Entities\Room', 'id_categoria_habitacion', 'room_category_id');
    }

}
