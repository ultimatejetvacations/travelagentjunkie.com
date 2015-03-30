<?php namespace App\Entities;

class TravelAgency extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'travel_agencies';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'travel_agency_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
