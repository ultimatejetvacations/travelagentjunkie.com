<?php namespace App\Repositories;

use App\Entities\MemberTraveler;
use App\Repositories\Contracts\IMemberTravelerRepository;

class MemberTravelerRepository extends BaseRepository implements IMemberTravelerRepository {

    /**
     * @var MemberTraveler
     */
    protected $entity;

    /**
     * @param MemberTraveler $memberTraveler
     */
    public function __construct(MemberTraveler $memberTraveler)
    {
        $this->entity = $memberTraveler;
    }

    /**
     * @return MemberTraveler
     */
    public function getEntity()
    {
        return $this->entity;
    }

}