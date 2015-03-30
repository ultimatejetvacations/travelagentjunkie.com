<?php namespace App\Repositories;

use App\Entities\PostSale;
use App\Repositories\Contracts\IPostSaleRepository;

class PostSaleRepository extends BaseRepository implements IPostSaleRepository {

    /**
     * @var PostSale
     */
    protected $entity;

    /**
     * @param PostSale $postSale
     */
    public function __construct(PostSale $postSale)
    {
        $this->entity = $postSale;
    }

    /**
     * @return PostSale
     */
    public function getEntity()
    {
        return $this->entity;
    }

}