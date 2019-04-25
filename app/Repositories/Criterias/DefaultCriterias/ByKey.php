<?php

namespace App\Repositories\Criterias\DefaultCriterias;

use App\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByKey implements Criteria
{
    private $value;

    /**
     * ByKey constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function apply(Builder $query)
    {
        if (!is_array($this->value)) {
            return $query->where($query->getModel()->getKeyName(), $this->value);
        }
        foreach ($this->value as $id) {
            $query->orWhere($query->getModel()->getKeyName(), $id);
        }

        return $query;

    }


}
