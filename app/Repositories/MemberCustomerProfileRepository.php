<?php namespace App\Repositories;

use App\Entities\MemberCustomerProfile;
use App\Repositories\Contracts\IMemberCustomerProfileRepository;

class MemberCustomerProfileRepository extends BaseRepository implements IMemberCustomerProfileRepository {

    /**
     * @var MemberCustomerProfile
     */
    protected $entity;

    /**
     * @param MemberCustomerProfile $memberCustomerProfile
     */
    public function __construct(MemberCustomerProfile $memberCustomerProfile)
    {
        $this->entity = $memberCustomerProfile;
    }

    /**
     * @return MemberCustomerProfile
     */
    public function getEntity()
    {
        return $this->entity;
    }

}