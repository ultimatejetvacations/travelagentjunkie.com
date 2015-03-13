<?php namespace App\Entities;

use App\Entities\Contracts\IQuoteOption;

class QuoteOption extends BaseEntity implements IQuoteOption {

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
    function quote()
    {
        return $this->belongsTo('App\Entities\Quote', 'quote_id', 'quote_id');
    }
}
