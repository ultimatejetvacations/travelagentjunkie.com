<?php namespace App\Repositories;

use App\Entities\Contracts\IQuoteOption;
use App\Repositories\Contracts\IQuoteOptionRepository;

class QuoteOptionRepository extends BaseRepository implements IQuoteOptionRepository {

    /**
     * @var IQuoteOption
     */
    protected $entity;

    /**
     * @param IQuoteOption $quote
     */
    public function __construct(IQuoteOption $quote)
    {
        $this->entity = $quote;
    }

    /**
     * @return IQuoteOption
     */
    public function getEntity()
    {
        return $this->entity;
    }
}