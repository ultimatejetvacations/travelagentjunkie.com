<?php namespace App\Entities;

class ResortFact extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'resort_facts';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_resort_facts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
