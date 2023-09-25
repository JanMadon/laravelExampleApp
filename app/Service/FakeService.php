<?php

namespace App\Service;

class FakeService
{
    private $config;

    public function __construct(string $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
