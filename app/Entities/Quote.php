<?php namespace App\Entities;

class Quote extends BaseEntity {

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
     * Return the quote member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne('App\Entities\Member', 'member_id', 'member_id');
    }

    /**
     * Return the post sale for that quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postSale()
    {
        return $this->hasOne('App\Entities\PostSale', 'quote_id', 'quote_id');
    }

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
