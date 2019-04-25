<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository as RepositoryInterface;
use App\Repositories\Criterias\Contracts\Criteria;
use App\Repositories\Criterias\CriteriaFactory;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository implements RepositoryInterface
{

    /**
     * @var CriteriaFactory
     */
    private $criteriaFactory;

    /**
     * @var Builder
     */
    private $queryBuilder;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Criteria[]
     */
    private $criterias;

    /**
     * Repository constructor.
     * @param CriteriaFactory $criteriaFactory
     * @param Model $model
     * @throws RepositoryException
     */
    public function __construct(CriteriaFactory $criteriaFactory, Model $model)
    {
        if (!$this->isSatisfy($model)) {
            throw new RepositoryException(
                sprintf("Given model (%s) is not satisfy repository (%s)", get_class($$model), get_class($this))
            );
        }

        $this->criteriaFactory = $criteriaFactory;
        $this->queryBuilder = $model->newQuery();
        $this->model = $model;
    }

    abstract protected function isSatisfy(Model $user): bool;

    /**
     * @param array $criterias
     * @return Builder[]|Collection
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    public function findByCriteria(array $criterias)
    {
        $this->refreshBuilder();
        $this->pushCriterias($criterias);
        $this->applyCriterias();

        return $this->queryBuilder->get();
    }

    private function refreshBuilder()
    {
        $this->queryBuilder = $this->model->newQuery();
        $this->criterias = [];
    }

    /**
     * @param array $criterias
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    private function pushCriterias(array $criterias)
    {
        foreach ($criterias as $criteria => $value) {
            $this->criterias[] = $this->buildCriteria($criteria, $value);
        }
    }

    private function applyCriterias(): void
    {
        foreach ($this->criterias as $criteria) {
            $this->queryBuilder = $criteria->apply($this->queryBuilder);
        }
    }

    /**
     * @param string $criteria
     * @param $value
     * @return Criteria
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    private function buildCriteria(string $criteria, $value): Criteria
    {
        return $this->criteriaFactory->buildCriteria($criteria, $value);
    }

    /**
     * @param array $criterias
     * @return mixed
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    public function findSingleByCriteria(array $criterias): Model
    {
        $results = $this->findByCriteria($criterias);

        return $this->getFirstResult($results);
    }

    /**
     * @param $results
     * @return Model
     */
    private function getFirstResult(Collection $results): Model
    {
        if ($results->isEmpty()) {
            throw new ModelNotFoundException();
        }

        return $results->first();
    }

    public function getModelInstance(): Model
    {
        return $this->model->newInstance();
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        $model->fresh();

        return $model;
    }

    /**
     * @param Model $model
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        $model->delete();
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }
}
