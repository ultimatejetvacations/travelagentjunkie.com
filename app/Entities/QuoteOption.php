<?php namespace App\Entities;

class QuoteOption extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'quote_option_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Return all the airlines within an option
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function airlines()
    {
        return $this->hasMany('App\Entities\QuoteOptionAirline', 'quote_option_id', 'quote_option_id');
    }

    /**
     * Return the quote option insurance
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insurance()
    {
        return $this->hasOne('App\Entities\Insurance', 'insurance_id', 'insurance_id');
    }

    /**
     * Return all the photos within an option
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Entities\QuoteOptionHotelRoomPhoto', 'quote_option_id', 'quote_option_id');
    }

    /**
     * Return the quote for an specific option
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quote()
    {
        return $this->belongsTo('App\Entities\Quote', 'quote_id', 'quote_id');
    }

    /**
     * Return the hotels within an option
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany('App\Entities\QuoteOptionHotelRoom', 'quote_option_id', 'quote_option_id');
    }

    /**
     * Return the service within an option
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendors()
    {
        return $this->hasMany('App\Entities\QuoteOptionVendor', 'quote_option_id', 'quote_option_id');
    }

}
