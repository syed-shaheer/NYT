<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\NytBestSellersRepository;
use App\Services\BestSellersService;
use Mockery;

class NytBestSellersRepositoryTest extends TestCase
{
    protected $bestSellersService;
    protected $nytBestSellersRepository;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the BestSellersService
        $this->bestSellersService = Mockery::mock(BestSellersService::class);

        // Create an instance of the repository with the mocked service
        $this->nytBestSellersRepository = new NytBestSellersRepository($this->bestSellersService);
    }

    /**
     * Test the getBestSellers method.
     *
     * @return void
     */
    public function test_getBestSellers()
    {
        // Define the input parameters
        $params = ['author' => 'Stephen King'];

        // Mock the service method
        $this->bestSellersService->shouldReceive('getBestSellers')
                                 ->once()
                                 ->with($params)
                                 ->andReturn(['status' => 'OK', 'results' => []]);

        // Call the repository method
        $response = $this->nytBestSellersRepository->getBestSellers($params);

        // Assert the response
        $this->assertEquals(['status' => 'OK', 'results' => []], $response);
    }

    protected function tearDown(): void
    {
        // Close Mockery
        Mockery::close();
        parent::tearDown();
    }
}