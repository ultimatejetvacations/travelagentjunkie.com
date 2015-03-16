<?php namespace App\Entities;

use App\Entities\Contracts\IPromotion;

class Promotion extends BaseEntity implements IPromotion {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_promotions';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_promotion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
