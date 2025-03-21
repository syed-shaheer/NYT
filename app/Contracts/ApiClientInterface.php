<?php

namespace App\Contracts;

interface ApiClientInterface
{
    public function get(string $endpoint, array $params = []);
}