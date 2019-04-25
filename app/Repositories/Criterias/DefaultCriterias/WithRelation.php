<?php

namespace App\Repositories\Criterias\DefaultCriterias;

use App\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class WithRelation implements Criteria
{
    private $value;

    /**
     * WithRelation constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function apply(Builder $query)
    {
        if (!is_array($this->value)) {
            return $query->with($this->value);
        }
        foreach ($this->value as $relation) {
            $query->with($relation);
        }

        return $query;
    }
}
