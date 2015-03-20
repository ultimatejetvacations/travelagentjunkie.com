<?php namespace App\Repositories;

use App\Entities\Quote;
use App\Repositories\Contracts\IQuoteRepository;

class QuoteRepository extends BaseRepository implements IQuoteRepository {

    /**
     * @var Quote
     */
    protected $entity;

    /**
     * @param Quote $quote
     */
    public function __construct(Quote $quote)
    {
        $this->entity = $quote;
    }

    /**
     * @return Quote
     */
    public function getEntity()
    {
        return $this->entity;
    }

}