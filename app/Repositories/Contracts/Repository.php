<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    public function findByCriteria(array $criterias);

    public function findSingleByCriteria(array $criterias): Model;

    public function getModelInstance(): Model;

    public function create(array $data): Model;

    public function update(Model $model, array $data): Model;

    public function delete(Model $model);

    public function save(Model $model): Model;
}
