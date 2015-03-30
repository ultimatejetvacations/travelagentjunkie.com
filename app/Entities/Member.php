<?php namespace App\Entities;

class Member extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'member_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Return the member agency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agency()
    {
        return $this->hasOne('App\Entities\TravelAgency', 'travel_agency_id', 'travel_agency_id');
    }

    /**
     * Return the member emails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('App\Entities\MemberEmails', 'member_id', 'member_id');
    }

}
