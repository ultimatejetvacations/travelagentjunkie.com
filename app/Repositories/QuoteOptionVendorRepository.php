<?php namespace App\Repositories;

use App\Entities\QuoteOptionVendor;
use App\Repositories\Contracts\IQuoteOptionVendorRepository;

class QuoteOptionVendorRepository extends BaseRepository implements IQuoteOptionVendorRepository {

    /**
     * @var QuoteOptionVendor
     */
    protected $entity;

    /**
     * @param QuoteOptionVendor $quoteOptionVendor
     */
    public function __construct(QuoteOptionVendor $quoteOptionVendor)
    {
        $this->entity = $quoteOptionVendor;
    }

    /**
     * @return QuoteOptionVendor
     */
    public function getEntity()
    {
        return $this->entity;
    }
}