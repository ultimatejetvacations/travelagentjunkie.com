<?php namespace App\Entities;

use App\Entities\Contracts\IRoom;

class Room extends BaseEntity implements IRoom {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categoria_habitacion';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_categoria_habitacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Return the hotel of the room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne('App\Entities\Hotel', 'id_hotel', 'id_hotel');
    }

}
