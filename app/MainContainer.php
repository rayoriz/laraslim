<?php

namespace App;

use Interop\Container\ContainerInterface;

class MainContainer
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
    
    public function getBaseUrl()
    {
        return $this->container->request->getUri()->getBaseUrl();
    }
}