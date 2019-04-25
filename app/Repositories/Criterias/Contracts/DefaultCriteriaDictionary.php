<?php

namespace App\Repositories\Criterias\Contracts;

interface DefaultCriteriaDictionary
{
    public const BY_KEY = 'id';
    public const WITH_RELATION = 'include_relation';
    public const BY_RELATION = 'relation';
}
