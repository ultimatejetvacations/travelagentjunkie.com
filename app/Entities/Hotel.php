<?php namespace App\Entities;

use App\Entities\Contracts\IHotel;

class Hotel extends BaseEntity implements IHotel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hotel';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_hotel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
