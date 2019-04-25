<?php

namespace App\Adapters\Config;

use App\Adapters\Config\Contracts\ConfigRepository as ConfigRepositoryInterface;
use Illuminate\Contracts\Config\Repository as LaravelConfig;

/**
 * Class ConfigRepository
 * @package App\Adapters\Config
 */
final class ConfigRepository implements ConfigRepositoryInterface
{
    /**
     * @var LaravelConfig
     */
    private $configRepository;

    /**
     * ConfigRepository constructor.
     * @param LaravelConfig $configRepository
     */
    public function __construct(LaravelConfig $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function get(string $alias)
    {
        return $this->configRepository->get($alias);
    }

}
