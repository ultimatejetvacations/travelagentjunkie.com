<?php namespace App\Entities;

class Hotel extends BaseEntity {

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

    /**
     * return the hotel facts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resortFact()
    {
        return $this->hasOne('App\Entities\ResortFact', 'id_hotel', 'id_hotel');
    }

}
