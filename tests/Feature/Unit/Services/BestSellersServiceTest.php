<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\BestSellersService;
use App\Contracts\ApiClientInterface;
use Illuminate\Support\Facades\Cache;
use Mockery;

class BestSellersServiceTest extends TestCase
{
    protected $apiClient;
    protected $bestSellersService;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the ApiClientInterface
        $this->apiClient = Mockery::mock(ApiClientInterface::class);

        // Create an instance of the service with the mocked client
        $this->bestSellersService = new BestSellersService($this->apiClient);
    }

    /**
     * Test the getBestSellers method with caching.
     *
     * @return void
     */
    public function test_getBestSellers_with_caching()
    {
        // Define the input parameters
        $params = ['author' => 'Stephen King'];
        $cacheKey = 'nyt_best_sellers_' . md5(serialize($params));

        // Mock the cache using spy()
        Cache::spy();
        
        // Define the expected response
        $expectedResponse = ['status' => 'OK', 'results' => []];
        
        // Set up the cache mock to return our expected response
        Cache::shouldReceive('remember')
            ->once()
            ->withArgs(function ($key, $ttl, $callback) use ($cacheKey) {
                return $key === $cacheKey && 
                       $ttl instanceof \Carbon\Carbon &&
                       is_callable($callback);
            })
            ->andReturn($expectedResponse);

        // Mock the API client (even though it shouldn't be called in this case)
        $this->apiClient->shouldReceive('get')
                        ->never(); // Ensure the API client is not called

        // Call the service method
        $response = $this->bestSellersService->getBestSellers($params);

        // Assert the response
        $this->assertEquals(['status' => 'OK', 'results' => []], $response);
    }

    /**
     * Test the getBestSellers method without caching.
     *
     * @return void
     */
    public function test_getBestSellers_without_caching()
    {
        // Define the input parameters
        $params = ['author' => 'Stephen King'];
        $cacheKey = 'nyt_best_sellers_' . md5(serialize($params));

        // Define expected API response
        $expectedResponse = ['status' => 'OK', 'results' => []];

        // Mock the API client first
        $this->apiClient->shouldReceive('get')
            ->once()
            ->with('lists/best-sellers/history.json', $params)
            ->andReturn($expectedResponse);

        // Mock the cache to simulate a cache miss and execute the callback
        Cache::shouldReceive('remember')
            ->once()
            ->withArgs(function ($key, $ttl, $callback) use ($cacheKey) {
                return $key === $cacheKey && 
                       $ttl instanceof \Carbon\Carbon &&
                       is_callable($callback);
            })
            ->andReturnUsing(function ($key, $ttl, $callback) {
                // Actually execute the callback to trigger the API call
                return $callback();
            });

        // Call the service method
        $response = $this->bestSellersService->getBestSellers($params);

        // Assert the response
        $this->assertEquals($expectedResponse, $response);
    }

    protected function tearDown(): void
    {
        // Close Mockery
        Mockery::close();
        parent::tearDown();
    }
}