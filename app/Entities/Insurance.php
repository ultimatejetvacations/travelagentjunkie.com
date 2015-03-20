<?php namespace App\Entities;

class Insurance extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'insurance';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'insurance_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
