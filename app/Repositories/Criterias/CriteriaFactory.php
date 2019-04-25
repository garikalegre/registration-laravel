<?php

namespace App\Repositories\Criterias;

use App\Adapters\Config\Contracts\ConfigRepository;
use App\Adapters\Container\Contracts\Container;
use App\Repositories\Criterias\Contracts\Criteria;
use App\Repositories\Criterias\Exceptions\CriteriaBuildException;

abstract class CriteriaFactory
{
    const SCHEMA = 'repository.criterias.schema';
    const DEFAULT_CRITERIAS = 'default';

    /**
     * @var Container
     */
    private $container;

    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * @var array
     */
    private $schema = [];

    /**
     * CriteriaFactory constructor.
     * @param Container $container
     * @param ConfigRepository $configRepository
     */
    public function __construct(Container $container, ConfigRepository $configRepository)
    {
        $this->container = $container;
        $this->configRepository = $configRepository;
        $this->schema = $this->getSchema();

    }

    /**
     * @return array
     */
    private function getSchema()
    {
        $defaultCriteriasConfigPath = sprintf('%s.%s', self::SCHEMA, self::DEFAULT_CRITERIAS);
        $customCriteriasConfigPath = sprintf('%s.%s', self::SCHEMA, $this->getContext());

        $defaultCriteriasSchema = $this->configRepository->get($defaultCriteriasConfigPath);
        $customCriteriasSchema = $this->configRepository->get($customCriteriasConfigPath);

        $schema = array_merge($defaultCriteriasSchema, $customCriteriasSchema);

        return $schema ?: [];
    }

    abstract protected function getContext(): string;

    /**
     * @param string $alias
     * @param $value
     * @return Criteria
     * @throws CriteriaBuildException
     */
    public function buildCriteria(string $alias, $value): Criteria
    {
        try {
            return $this->proceedBuilding($alias, $value);
        } catch (\Throwable $exception) {
            throw new CriteriaBuildException(
                sprintf('Cannot build criteria by given alias - %s, %s',
                    $alias,
                    $exception->getMessage())
            );
        }
    }

    /**
     * @param string $alias
     * @param $value
     * @return Criteria
     */
    private function proceedBuilding(string $alias, $value)
    {
        return $this->getInstance($this->schema[$alias], $value);
    }

    /**
     * @param string $className
     * @param $value
     * @return Criteria
     */
    private function getInstance(string $className, $value): Criteria
    {
        return $this->container->makeWith($className, ['value' => $value]);
    }

}
