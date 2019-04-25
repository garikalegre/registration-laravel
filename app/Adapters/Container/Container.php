<?php

namespace App\Adapters\Container;

use App\Adapters\Container\Contracts\Container as ContainerInterface;
use Illuminate\Contracts\Container\Container as LaravelContainer;

/**
 * Class Container
 * @package App\Utilites\Adapters\Container
 */
final class Container implements ContainerInterface
{
    /**
     * @var LaravelContainer
     */
    private $container;

    /**
     * Container constructor.
     * @param LaravelContainer $container
     */
    public function __construct(LaravelContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $className
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function make(string $className)
    {
        return $this->container->make($className);
    }

    public function makeWith(string $className, array $parameters = [])
    {
        return $this->container->make($className, $parameters);
    }

}
