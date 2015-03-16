<?php namespace App\Entities;

use App\Entities\Contracts\IRoomPhoto;

class RoomPhoto extends BaseEntity implements IRoomPhoto {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'room_categories_photo';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_room_categories_photo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
