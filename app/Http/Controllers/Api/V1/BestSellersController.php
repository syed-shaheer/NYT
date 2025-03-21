<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller; 
use App\Http\Requests\Api\V1\BestSellersRequest;
use App\Repositories\BestSellersRepositoryInterface;

class BestSellersController extends Controller
{
    protected $bestSellersRepository;

    public function __construct(BestSellersRepositoryInterface $bestSellersRepository)
    {
        $this->bestSellersRepository = $bestSellersRepository;
    }

    public function index(BestSellersRequest $request)
    {
        // The request is already validated at this point
        $params = $request->validated();
        $response = $this->bestSellersRepository->getBestSellers($params);

        return response()->json($response);
    }
}