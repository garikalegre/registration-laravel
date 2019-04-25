<?php

namespace App\Repositories\Criterias\DefaultCriterias;


use App\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByRelation implements Criteria
{
    private $value;

    /**
     * ByRelation constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function apply(Builder $query)
    {
        return $query->has($this->value);
    }

}
