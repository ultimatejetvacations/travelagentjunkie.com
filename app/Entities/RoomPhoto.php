<?php namespace App\Entities;

class RoomPhoto extends BaseEntity {

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
