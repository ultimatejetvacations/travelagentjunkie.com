<?php namespace App\Repositories;

use App\Entities\QuoteOption;
use App\Repositories\Contracts\IQuoteOptionRepository;

class QuoteOptionRepository extends BaseRepository implements IQuoteOptionRepository {

    /**
     * @var QuoteOption
     */
    protected $entity;

    /**
     * @param QuoteOption $quote
     */
    public function __construct(QuoteOption $quote)
    {
        $this->entity = $quote;
    }

    /**
     * @return QuoteOption
     */
    public function getEntity()
    {
        return $this->entity;
    }
}