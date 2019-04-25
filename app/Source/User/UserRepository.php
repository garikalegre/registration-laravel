<?php

namespace App\Source\User;

use App\Repositories\Repository;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    public function __construct(UserCriteriaFactory $criteriaFactory, User $user)
    {
        parent::__construct($criteriaFactory, $user);
    }

    protected function isSatisfy(Model $user): bool
    {
        return $user instanceof User;
    }

    public function findByCriteria(array $criterias)
    {
        return parent::findByCriteria($criterias);
    }
}
