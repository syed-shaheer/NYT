<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use App\Repositories\BestSellersRepositoryInterface;
use Mockery;
use Illuminate\Http\Response;

class BestSellersTest extends TestCase
{
    /**
     * Test a valid request to the best sellers endpoint.
     *
     * @return void
     */
    public function test_valid_request()
    {
        // Mock the repository
        $mockRepository = Mockery::mock(BestSellersRepositoryInterface::class);
        $mockRepository->shouldReceive('getBestSellers')
                       ->once()
                       ->with(['author' => 'Stephen King'])
                       ->andReturn(['status' => 'OK', 'results' => []]);

        // Bind the mock repository in the service container
        $this->app->instance(BestSellersRepositoryInterface::class, $mockRepository);

        // Make the request
        $response = $this->getJson('/api/v1/best-sellers?author=Stephen+King');

        // Assert the response
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(['status', 'results']);
    }

    /**
     * Test an invalid request with an invalid offset.
     *
     * @return void
     */
    public function test_invalid_offset()
    {
        // Make the request with an invalid offset
        $response = $this->getJson('/api/v1/best-sellers?offset=15');

        // Assert the response
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                 ->assertJsonValidationErrors(['offset']);
    }

    /**
     * Test a request with no parameters.
     *
     * @return void
     */
    public function test_no_parameters()
    {
        // Mock the repository
        $mockRepository = Mockery::mock(BestSellersRepositoryInterface::class);
        $mockRepository->shouldReceive('getBestSellers')
                       ->once()
                       ->with([])
                       ->andReturn(['status' => 'OK', 'results' => []]);

        // Bind the mock repository in the service container
        $this->app->instance(BestSellersRepositoryInterface::class, $mockRepository);

        // Make the request
        $response = $this->getJson('/api/v1/best-sellers');

        // Assert the response
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(['status', 'results']);
    }

    protected function tearDown(): void
    {
        // Close Mockery
        Mockery::close();
        parent::tearDown();
    }
}