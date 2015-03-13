<?php namespace App\Entities;

use App\Entities\Contracts\IHotelPhoto;

class HotelPhoto extends BaseEntity implements IHotelPhoto {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hotel_photo_new';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_hotel_photo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
