<?php namespace App\Repositories;

use App\Entities\Contracts\IQuote;
use App\Repositories\Contracts\IQuoteRepository;

class QuoteRepository extends BaseRepository implements IQuoteRepository {

    /**
     * @var IQuote
     */
    protected $entity;

    /**
     * @param IQuote $quote
     */
    public function __construct(IQuote $quote)
    {
        $this->entity = $quote;
    }

    /**
     * @return IQuote
     */
    public function getEntity()
    {
        return $this->entity;
    }

}