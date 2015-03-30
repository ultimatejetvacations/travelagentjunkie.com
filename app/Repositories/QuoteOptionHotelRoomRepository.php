<?php namespace App\Repositories;

use App\Entities\QuoteOptionHotelRoom;
use App\Repositories\Contracts\IQuoteOptionHotelRoomRepository;

class QuoteOptionHotelRoomRepository extends BaseRepository implements IQuoteOptionHotelRoomRepository {

    /**
     * @var QuoteOptionHotelRoom
     */
    protected $entity;

    /**
     * @param QuoteOptionHotelRoom $quoteOptionHotelRoom
     */
    public function __construct(QuoteOptionHotelRoom $quoteOptionHotelRoom)
    {
        $this->entity = $quoteOptionHotelRoom;
    }

    /**
     * @return QuoteOptionHotelRoom
     */
    public function getEntity()
    {
        return $this->entity;
    }
}