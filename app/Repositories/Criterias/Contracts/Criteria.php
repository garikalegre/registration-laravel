<?php

namespace App\Repositories\Criterias\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Criteria
{
    public function apply(Builder $query);
}
