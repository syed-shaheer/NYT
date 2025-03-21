<?php

namespace App\Services;

use App\Contracts\ApiClientInterface;
use Illuminate\Support\Facades\Http;

class NytApiClient implements ApiClientInterface
{
    protected $apiKey;
    protected $baseUrl;
    protected $endpoints;

    public function __construct()
    {
        $this->apiKey = env('NYT_API_KEY');
        $config = config('api.nyt'); // Retrieve NYT API configuration
        $this->baseUrl = $config['base_url'];
        $this->endpoints = $config['endpoints'];
    }

    public function get(string $endpoint, array $params = [])
    {
        // Ensure the endpoint key exists in the configuration
        if (!isset($this->endpoints[$endpoint])) {
            throw new \InvalidArgumentException("Endpoint '{$endpoint}' not found in configuration.");
        }

        $url = $this->baseUrl . $this->endpoints[$endpoint];
        $params['api-key'] = $this->apiKey;
        
        return Http::get($url, $params)->json();
    }
}