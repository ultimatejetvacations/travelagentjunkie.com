<?php namespace App\Entities;

class PostSaleTraveler extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_sale_travelers';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'traveler_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['traveler_id', 'quote_id'];

    /**
     * Return the actual member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function memberTraveler()
    {
        return $this->hasOne('App\Entities\MemberTraveler', 'traveler_id', 'traveler_id');
    }

}
