<?php namespace App\Repositories;

use App\Entities\QuoteOptionAirline;
use App\Repositories\Contracts\IQuoteOptionAirlineRepository;

class QuoteOptionAirlineRepository extends BaseRepository implements IQuoteOptionAirlineRepository {

    /**
     * @var QuoteOptionAirline
     */
    protected $entity;

    /**
     * @param QuoteOptionAirline $quoteOptionAirline
     */
    public function __construct(QuoteOptionAirline $quoteOptionAirline)
    {
        $this->entity = $quoteOptionAirline;
    }

    /**
     * @return QuoteOptionAirline
     */
    public function getEntity()
    {
        return $this->entity;
    }
}