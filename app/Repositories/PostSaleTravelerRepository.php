<?php namespace App\Repositories;

use App\Entities\PostSaleTraveler;
use App\Repositories\Contracts\IPostSaleTravelerRepository;

class PostSaleTravelerRepository extends BaseRepository implements IPostSaleTravelerRepository {

    /**
     * @var PostSaleTraveler
     */
    protected $entity;

    /**
     * @param PostSaleTraveler $postSaleTraveler
     */
    public function __construct(PostSaleTraveler $postSaleTraveler)
    {
        $this->entity = $postSaleTraveler;
    }

    /**
     * @return PostSaleTraveler
     */
    public function getEntity()
    {
        return $this->entity;
    }

}