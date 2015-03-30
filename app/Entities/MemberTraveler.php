<?php namespace App\Entities;

use Carbon\Carbon;

class MemberTraveler extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_travelers';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'traveler_id';

    /**
     * Fields to be treated as Carbon instances
     *
     * @var array
     */
    protected $dates = ['date_of_birth'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'job_title',
        'relationship',
        'date_of_birth',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'frequent_flyer_numbers',
    ];

    /**
     * Format date of birth
     *
     * @param $value
     */
    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('m/d/Y', $value);
    }

}
