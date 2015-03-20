<?php namespace App\Entities;

class Vendor extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
