<?php namespace App\Entities;

class PostSale extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_sale';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'quote_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Return the actual member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postSaleTravelers()
    {
        return $this->hasOne('App\Entities\PostSaleTraveler', 'quote_id', 'quote_id');
    }

}
