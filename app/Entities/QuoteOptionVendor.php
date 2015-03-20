<?php namespace App\Entities;

class QuoteOptionVendor extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quote_options_vendors';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'quote_options_vendor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Return the actual vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne('App\Entities\Vendor', 'vendor_id', 'vendor_id');
    }
}
