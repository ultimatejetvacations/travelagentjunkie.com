<?php namespace App\Entities;

use App\Entities\Contracts\IQuote;

class Quote extends BaseEntity implements IQuote {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quotes';

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
     * Return the options for an specific quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quoteOptions()
    {
        return $this->hasMany('App\Entities\QuoteOption', 'quote_id', 'quote_id');
    }

}
