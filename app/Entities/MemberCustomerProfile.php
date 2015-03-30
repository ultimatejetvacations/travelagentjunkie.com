<?php namespace App\Entities;

use App\Services\Authorize\Authorize;
use App\Services\Authorize\Config;

class MemberCustomerProfile extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_customer_profiles';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'customerProfileId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'traveler_id', 'customerProfileId'];

    /**
     * Return the actual member profile
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function memberTraveler()
    {
        return $this->hasOne('App\Entities\MemberTraveler', 'traveler_id', 'traveler_id');
    }

    /**
     * Return the customer profile from authorize
     *
     * @param Authorize $authorize
     * @return mixed
     */
    public function authorizeProfile($test = false)
    {
        $authorize = new Authorize($test);
        return $authorize->getProfile($this->attributes['customerProfileId']);
    }

}
