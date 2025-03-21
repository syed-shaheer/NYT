<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Contracts\ApiClientInterface;

class BestSellersService
{
    protected $apiClient;

    public function __construct(ApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getBestSellers(array $params)
    {
        $cacheKey = 'nyt_best_sellers_' . md5(serialize($params));
        
        return Cache::remember($cacheKey, now()->addHours(1), function () use ($params) {
            return $this->apiClient->get('best_sellers', $params);
        });
    }
}