<?php

namespace App\Repositories;

use App\Services\BestSellersService;

class NytBestSellersRepository implements BestSellersRepositoryInterface
{
    protected $bestSellersService;

    public function __construct(BestSellersService $bestSellersService)
    {
        $this->bestSellersService = $bestSellersService;
    }

    public function getBestSellers(array $params)
    {
        return $this->bestSellersService->getBestSellers($params);
    }
}