<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface;

class Controller
{
    protected $container;
    protected $logger;

    public function __construct($container)
    {
        $this->container = $container;
        $this->setLogger();
    }

    private function setLogger()
    {
        $this->logger = $this->container->logger;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}