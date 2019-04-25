<?php

namespace App\Source\User;

use App\Repositories\Criterias\CriteriaFactory;

class UserCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'user';

    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}
